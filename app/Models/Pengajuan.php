<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_surat',
        'tanggal_surat',
        'asal_surat',
        'asal_surat_lainnya',
        'status'
    ];

   public function tujuanSurats()
{
    return $this->hasMany(\App\Models\TujuanSurat::class);
}

public function tembusanSurats()
{
    return $this->hasMany(\App\Models\TembusanSurat::class);
}

public function tujuanKabkotas()
{
    return $this->hasMany(\App\Models\TujuanKabkota::class);
}

public function berkas()
{
    return $this->hasMany(\App\Models\Berkas::class);
}

}
