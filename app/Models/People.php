<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class People extends Authenticatable
{
    use HasFactory;

    protected $table = "people";
    protected $fillable = [
        "nama",
        "nis",
        "jk",
        "no_telp",
        "asrama",
        "kelas",
        "line_id",
        "photo_path",
        "jenjang",
        "remember_token",
        "password",
    ];
}
