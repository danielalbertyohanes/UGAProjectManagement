<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ppt extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "ppts";
    protected $fillable = [
        'topic_id',
        'type',
        'subtopic_code',
        'subtopic_name',
        'ppt_path',
        'status',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
