<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;

    protected $table = 'pekerjaan'; // Make sure this is correct

    protected $fillable = [
        'nama',
        'jabatan',
        'tanggalmulai',
        'tanggalselesai',
        'negara',
        'jenis',
        'deskripsi',
        'user_id'
    ];
}
