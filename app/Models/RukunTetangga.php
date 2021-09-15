<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RukunTetangga extends Authenticatable
{
    use HasFactory;
    protected $table = "rukun_tetangga";
    protected $fillable = [
        "kode",
        "username",
        "nama",
        "kontak",
        "password",
        "alamat",
        "id_rw"
    ];

    protected $append = ['rw_detail', 'join_info','keluarga_count'];

    function getRwDetailAttribute()
    {
        return RukunWarga::find($this->id_rw);
    }

    function getJoinInfoAttribute()
    {
        $rw = RukunWarga::find($this->id_rw);
        $info = $this->kode . " - " . $rw->kode;
        return $info;
    }

    function getKeluargaCountAttribut()
    {
        $info = Keluarga::where('rt', '=', $this->id)->count();
        return $info;
    }
}
