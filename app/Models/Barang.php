<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'jumlah', 'tgl_awal', 'kondisi', 'wahana_id'];

    public function Wahana(): BelongsTo
    {
        return $this->belongsTo(Wahana::class);
    }
}
