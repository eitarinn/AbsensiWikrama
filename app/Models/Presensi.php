<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensis';
    protected $fillable = ['nis', 'jam_kepulangan', 'jam_kedatangan', 'tanggal', 'keterangan', 'foto'];
}
