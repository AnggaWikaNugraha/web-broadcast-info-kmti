<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function info(): HasMany
    // {
    //     return $this->hasMany(Info::class);
    // }
}
