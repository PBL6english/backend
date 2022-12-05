<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_exam_enroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'quest_id',
        'exam_id',
        'status',
    ];
}
