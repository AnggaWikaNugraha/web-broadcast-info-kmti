<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    use HasFactory;

    protected $table = 'info';

    protected $fillable = [
        'content',
        'file',
        'subject'
    ];

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class, 'broadcast', 'info_id', 'mahasiswa_id')->withPivot('tanggal_kirim', 'status', 'id' );
    }

    /**
     * Get the divisi that owns the Info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'kmti_id');
    }

}
