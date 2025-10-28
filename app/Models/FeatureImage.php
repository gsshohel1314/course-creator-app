<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureImage extends Model
{
    protected $fillable = ['course_id', 'image_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
