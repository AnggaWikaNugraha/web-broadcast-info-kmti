<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'kmti';

    protected $fillable = [
        'nama_divisi',
        'keterangan',
        'foto',
        'fungsi'
    ];

    public function mahasiswa(){
        // argument
        // model class
        // tabel barunya
        // id pertama
        // id kedua
        return $this->belongsToMany(Mahasiswa::class, 'kmti_mahasiswa', 'kmti_id', 'mahasiswa_id');
    }

    /**
     * Get all of the info for the Divisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info(): HasOne
    {
        return $this->hasOne(Info::class, 'info_id');
    }

}
