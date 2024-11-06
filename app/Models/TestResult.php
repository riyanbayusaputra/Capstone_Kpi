<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    // The table associated with the model
 //   protected $table = 'test_results';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'category_id',
        'score',
    ];

    /**
     * Relationship with the User model.
     * Each test result belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with the Category model.
     * Each test result belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    /**
     * Relationship with the UserAnswer model.
     * Each test result has many user answers.
     */
     // Relasi dengan UserAnswer
     public function userAnswers()
     {
         return $this->hasMany(UserAnswer::class);
     }
    /**
     * Optional: Enable eager loading of related models.
     * This can help avoid N+1 query issues.
     */
    //protected $with = ['user', 'category', 'userAnswers'];
}