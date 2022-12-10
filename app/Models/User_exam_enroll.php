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

    public function User_exam_question_answer()
    {
        return $this->hasMany('App\Models\User_exam_question_answer','enroll_id','id');
    }
}
