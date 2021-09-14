<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'info';

    protected $fillable = [
        'content',
        'file',
    ];

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class);
    }

}