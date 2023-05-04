<?php

namespace App\Models;

use App\Models\Cuti;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Penggajian;
use App\Models\RiwayatJabatan;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory, Filterable;

    
    protected $table = 'pegawai';
    protected $guarded = [];
    public $timestamps = false;

    public function jabatan()
    {

        return $this->belongsTo(Jabatan::class);
    }
    
    public function riwayat_jabatans()
    {

        return $this->hasMany(RiwayatJabatan::class);
    }
    
    public function riwayat_jabatan()
    {

        return $this->hasOne(RiwayatJabatan::class);
    }

    public function cutis()
    {

        return $this->hasMany(Cuti::class);
    }

    public function penggajians()
    {

        return $this->hasMany(Penggajian::class);
    }

    public function absensis()
    {

        return $this->hasMany(Absensi::class);
    }
}
