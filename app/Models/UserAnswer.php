<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'user_answer',
        'correct_answer',
        'is_correct',
        'category_id',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}