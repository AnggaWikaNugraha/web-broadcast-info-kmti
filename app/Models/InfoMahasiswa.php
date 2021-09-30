<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfoMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'info_mahasiswa';

    /**
     * Get the mahasiswa that owns the InfoMahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /**
     * Get the Info that owns the InfoMahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info(): BelongsTo
    {
        return $this->belongsTo(Info::class);
    }
}
