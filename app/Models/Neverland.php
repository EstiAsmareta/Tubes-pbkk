<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neverland extends Model
{
    use HasFactory;

    protected $table = 'neverlands';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'lokasi', 'pemilik', 'tgl_berdiri'];
}
