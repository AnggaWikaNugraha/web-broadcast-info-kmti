<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'name',
        'nim',
        'no_wa',
        'angkatan',
        'id_tele',
        'status',
        'jenis_kelamin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function info(){
        return $this->belongsToMany(Info::class)->withPivot('tanggal_kirim', 'status');
    }
}
