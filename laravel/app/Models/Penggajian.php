<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian';
    protected $guarded = [];
    public $timestamps = false;

    public function pegawai()
    {
        
        return $this->belongsTo(Pegawai::class);
    }

    public function riwayat_jabatan()
    {
        
        return $this->where([
            'pegawai_id' => $this->id,
            'status' => 'Aktif'
        ])->first();
    }
}
