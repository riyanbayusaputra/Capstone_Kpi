<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers'; // Nama tabel yang terkait dengan model ini
    
    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
    ];

    /**
     * Relasi antara Answer dan Question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}