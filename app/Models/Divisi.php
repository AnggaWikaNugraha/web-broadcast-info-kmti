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
        return $this->belongsToMany(Mahasiswa::class);
    }

    /**
     * Get all of the info for the Divisi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info(): HasOne
    {
        return $this->hasOne(Info::class);
    }

}
