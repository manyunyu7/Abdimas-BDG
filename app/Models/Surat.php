<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_warga","id_rt","id_rw","nomor_surat","keperluan",
        "nama_lengkap","tempat","tanggal_lahir","pekerjaan",
        "agama","status_perkawinan","keterangan","current_rt",
        "current_rt","current_rw","nama_rt","nama_rt","sekretariat",
        "telepon","kodepos","is_rt_approved","is_rw_approved",
        "id_cap_rt","id_cap_rw","id_ttd_rt","id_ttd_rw","status","alamat_pemohon"
    ];
  
    
}
