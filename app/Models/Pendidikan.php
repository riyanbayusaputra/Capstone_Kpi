<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;

    protected $table = 'pendidikan'; // Make sure this is correct

    protected $fillable = [
        'pendidikan',
        'namasekolah',
        'tanggalmasuk',
        'tanggallulus',
        'gelar',
        'ipk',
        'nilaiRataRata',
        'alamatlengkap',
        'deskripsi',
        'user_id'
    ];
}
