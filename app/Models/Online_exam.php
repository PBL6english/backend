<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Online_exam extends Model
{
    use HasFactory;


    protected $table = 'online_exams';

    protected $fillable = [
        'title',
        'total_question',
        'duration',
        'user_id',
    ];

    public function User_exam_question_answer()
    {
        return $this->hasMany('App\Models\User_exam_question_answer','exam_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
