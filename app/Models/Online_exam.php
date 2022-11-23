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
}
