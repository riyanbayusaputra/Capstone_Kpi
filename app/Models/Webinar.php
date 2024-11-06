<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'icon',
        'sampul',
        'peserta',
    ];

    public function registrations()
    {
        return $this->hasMany(WebinarRegistration::class);
    }

    // Method untuk menghitung jumlah peserta
    public function getRegistrationsCountAttribute()
    {
        return $this->registrations()->count();
    }

}
