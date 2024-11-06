<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    // Tentukan nama tabel jika berbeda
    protected $table = 'categoriespsikotes';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = ['name', 'description', 'image'];

    // Jika model ini memiliki relasi dengan model lain, tambahkan relasi di sini
    public function questions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }

    public function testResults()
    {
    return $this->hasMany(TestResult::class, 'category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    

}