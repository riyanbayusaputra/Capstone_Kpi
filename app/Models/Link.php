<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'links';

    // Menentukan kolom mana yang dapat diisi secara massal
    protected $fillable = [
        'title',
        'content',
    ];

    // Jika Anda menggunakan timestamps (created_at dan updated_at) di tabel
    public $timestamps = true;

    // Atau jika Anda tidak menggunakan timestamps, set false
    // public $timestamps = false;
}
