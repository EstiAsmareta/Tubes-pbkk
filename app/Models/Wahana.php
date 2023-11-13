<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wahana extends Model
{
    use HasFactory;

    protected $table = 'wahanas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama', 'gambar', 'deskripsi', 'tgl_dibuka', 'luas_area', 'neverland_id'];

    public function Neverland(): BelongsTo
    {
        return $this->belongsTo(Neverland::class);
    }
}
