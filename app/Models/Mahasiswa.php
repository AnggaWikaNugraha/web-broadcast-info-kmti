<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function divisi(){
        return $this->belongsToMany(Divisi::class, 'kmti_mahasiswa', 'kmti_id', 'mahasiswa_id');
    }

    /**
     * Get all of the notifications for the Mahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(InfoMahasiswa::class);
    }

}
