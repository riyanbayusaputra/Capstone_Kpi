<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPribadi extends Model
{
    protected $fillable = [
        'nama', 'tempatLahir', 'tanggalLahir', 'email', 'noHp', 'alamat', 'gender', 'deskripsi', 'uploadFoto', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'informasi_pribadi'; // Make sure this is correct
}
