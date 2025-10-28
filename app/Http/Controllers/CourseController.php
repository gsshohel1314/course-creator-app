<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use App\Traits\FileHandler;
use App\Models\FeatureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    use FileHandler;
    
    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {        
        // dd($request->all());
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Create the course
            $courseData = [
                'title' => $validated['title'],
                'level' => $validated['level'],
                'category' => $validated['category'],
                'price' => $validated['price'],
                'summary' => $validated['summary'],
            ];

            // File upload using trait methods
            if ($request->hasFile('feature_video') && $request->file('feature_video')->isValid()) {
                $video = $request->file('feature_video');
                $videoPath = $this->uploadFile($video, 'uploads/videos');
                $courseData['feature_video'] = $videoPath;
            }

            $course = Course::create($courseData);

            // Handle feature images
            if ($request->hasFile('feature_image')) {
                foreach ($request->file('feature_image') as $image) {
                    $imagePath = $this->uploadFile($image, 'uploads/images');
                    FeatureImage::create([
                        'course_id' => $course->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }

            // Create modules and contents
            foreach ($validated['modules'] as $moduleData) {
                $module = Module::create([
                    'course_id' => $course->id,
                    'title' => $moduleData['title'],
                ]);

                foreach ($moduleData['contents'] as $contentData) {
                    Content::create([
                        'module_id' => $module->id,
                        'title' => $contentData['title'],
                        'source_type' => $contentData['source_type'],
                        'video_url' => $contentData['video_url'] ?? null,
                        'video_length' => $contentData['video_length'] ?? null,
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Course created successfully!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Course created faild: ' . $e->getMessage()])->withInput();
        }
    }
}
