<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'question_text',
        'question_gambar',
        'option_a',
        'option_a_image',
        'option_b',
        'option_b_image',
        'option_c',
        'option_c_image',
        'option_d',
        'option_d_image',
        'correct_answer',
        'category_id' // Tambahkan category_id
    ];

    // Definisikan aksesors jika perlu (misalnya, untuk mendapatkan URL lengkap dari gambar)
    public function getOptionAImageUrlAttribute()
    {
        return $this->option_a_image ? asset('storage/' . $this->option_a_image) : null;
    }

    public function getOptionBImageUrlAttribute()
    {
        return $this->option_b_image ? asset('storage/' . $this->option_b_image) : null;
    }

    public function getOptionCImageUrlAttribute()
    {
        return $this->option_c_image ? asset('storage/' . $this->option_c_image) : null;
    }

    public function getOptionDImageUrlAttribute()
    {
        return $this->option_d_image ? asset('storage/' . $this->option_d_image) : null;
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}