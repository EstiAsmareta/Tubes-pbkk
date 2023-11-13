<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama', 'alamat', 'tgl_lahir', 'jabatan', 'wahana_id'];

    public function Wahana(): BelongsTo
    {
        return $this->belongsTo(Wahana::class);
    }
}
