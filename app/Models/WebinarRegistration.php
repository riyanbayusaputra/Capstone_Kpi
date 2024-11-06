<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    // Definisikan kolom yang dapat diisi
    protected $fillable = ['user_id', 'webinar_id'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Webinar
    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    // Event listener untuk model WebinarRegistration
    public static function boot()
    {
        parent::boot();

        // Tambahkan logika khusus ketika membuat pendaftaran
        static::creating(function ($registration) {
            // Contoh logika kustom, misalnya hanya pekerja yang bisa mendaftar
            if (!$registration->user->isEmployee()) {
                throw new \Exception("Only employees can register for webinars.");
            }
        });
    }
}
