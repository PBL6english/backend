<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_exam_question_answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'user_answer',
        'score_status',
    ];
}
