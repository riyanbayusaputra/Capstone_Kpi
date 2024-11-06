<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialLink extends Model
{
    use HasFactory;

    // Update the table name if it has changed
    protected $table = 'link'; // Ensure this matches your migration

    // Define the fields that are mass assignable
    protected $fillable = [
        'user_id', 'fb', 'ig', 'linkedin', 'tiktok'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
