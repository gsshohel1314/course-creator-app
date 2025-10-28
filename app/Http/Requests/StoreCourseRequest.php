<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'feature_video' => 'nullable|file|mimes:mp4,avi,mov,quicktime|max:102400', // 100MB max
            'level' => 'required|string|max:255',
            'category' => 'required|string|in:programming,design,marketing',
            'price' => 'required|numeric|min:0',
            'summary' => 'required|string',
            'feature_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max per image
            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.source_type' => 'required|string|in:youtube,vimeo,upload,direct',
            'modules.*.contents.*.video_url' => 'nullable|url|max:255',
            'modules.*.contents.*.video_length' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            // title
            'title.required' => 'The course title is required.',
            'title.string' => 'The course title must be a string.',
            'title.max' => 'The course title may not be greater than 255 characters.',

            // feature_video
            'feature_video.file' => 'The feature video must be a valid file.',
            'feature_video.mimes' => 'The feature video must be in MP4, AVI, or MOV format.',
            'feature_video.max' => 'The feature video may not be larger than 100MB.',

            // level
            'level.required' => 'The course level is required.',
            'level.string' => 'The course level must be a string.',
            'level.max' => 'The course level may not be greater than 255 characters.',

            // category
            'category.required' => 'The course category is required.',
            'category.string' => 'The course category must be a string.',
            'category.in' => 'The course category must be one of: programming, design, or marketing.',

            // price
            'price.required' => 'The course price is required.',
            'price.numeric' => 'The course price must be a number.',
            'price.min' => 'The course price must be at least 0.',

            // summary
            'summary.required' => 'The course summary is required.',
            'summary.string' => 'The course summary must be a string.',

            // feature_image
            'feature_image.*.image' => 'Each feature image must be a valid image.',
            'feature_image.*.mimes' => 'Each feature image must be in JPEG, PNG, JPG, or GIF format.',
            'feature_image.*.max' => 'Each feature image may not be larger than 2MB.',

            // modules
            'modules.required' => 'At least one module is required.',
            'modules.array' => 'Modules must be an array.',
            'modules.min' => 'At least one module must be provided.',

            // modules.*.title
            'modules.*.title.required' => 'Each module title is required.',
            'modules.*.title.string' => 'Each module title must be a string.',
            'modules.*.title.max' => 'Each module title may not be greater than 255 characters.',

            // modules.*.contents
            'modules.*.contents.required' => 'Each module must have at least one content.',
            'modules.*.contents.array' => 'Module contents must be an array.',
            'modules.*.contents.min' => 'Each module must have at least one content.',

            // modules.*.contents.*.title
            'modules.*.contents.*.title.required' => 'Each content title is required.',
            'modules.*.contents.*.title.string' => 'Each content title must be a string.',
            'modules.*.contents.*.title.max' => 'Each content title may not be greater than 255 characters.',

            // modules.*.contents.*.source_type
            'modules.*.contents.*.source_type.required' => 'Each content source type is required.',
            'modules.*.contents.*.source_type.string' => 'Each content source type must be a string.',
            'modules.*.contents.*.source_type.in' => 'Each content source type must be one of: YouTube, Vimeo, upload, or direct.',

            // modules.*.contents.*.video_url
            'modules.*.contents.*.video_url.url' => 'The video URL must be a valid URL.',
            'modules.*.contents.*.video_url.max' => 'The video URL may not be greater than 255 characters.',

            // modules.*.contents.*.video_length
            'modules.*.contents.*.video_length.numeric' => 'The video length must be a number.',
            'modules.*.contents.*.video_length.min' => 'The video length must be at least 0.',
        ];
    }
}
