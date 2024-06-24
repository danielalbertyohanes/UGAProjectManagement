<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subtopic extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "sub_topics";
    protected $fillable = [
        'name',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function ppts()
    {
        return $this->hasMany(PPT::class);
    }
}
