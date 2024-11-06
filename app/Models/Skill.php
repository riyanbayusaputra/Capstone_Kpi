<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // Update the table name if it has changed
    protected $table = 'skills'; // Ensure this matches your migration

    // Define the fields that are mass assignable
    protected $fillable = [
        'bidang',
        'posisikerja',
        'keahlian',
        'deskripsi',
        'keterampilan',
        'user_id'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
