<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "topics";
    protected $fillable = [
        'panduan_rpp_path',
        'template_rpp_path',
        'uploaded_rpp_path',
        'jumlah_video',
        'status',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function subtopics()
    {
        return $this->hasMany(Subtopic::class);
    }
}
