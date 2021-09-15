<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    use HasFactory;
    protected $table = "anggota_keluarga";

    protected $fillable=[
        "id_keluarga",
        "nik",
        "nama",
        "gender",
        "tempat_lahir",
        "tanggal_lahir",
        "agama",
        "pendidikan",
        "pekerjaan",
        "current_address",
        "path_ktp",
    ];

    
}
