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
        'enroll_id',
        'question_id',
        'user_answer',
        'correct_answer',
        'score_status',
    ];

    public function exam(){
        return $this->belongsTo('App\Models\Online_exam','exam_id','id');
    }

    public function exam_enroll(){
        return $this->belongsTo('App\Models\Online_exam','enroll_id','id');
    }
}
