<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Keluarga extends Authenticatable{
    use HasFactory;
    protected $table = "keluarga";
    protected $fillable=[
        "id",
        "no_kk",
        "nama",
        "email",
        "password",
        "kontak",
        "alamat",
        "photo_kartu_keluarga",
        "rt",
        "rw",
    ];

    protected $appends = ['rt_detail','anggota','jumlah_anggota'];

    function getRtDetailAttribute(){
        return RukunTetangga::find($this->rt);
    }

    function getJumlahAnggotaAttribute(){
        return AnggotaKeluarga::where('id_keluarga','=',$this->id)->count();
    }

}
