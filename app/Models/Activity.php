<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activity";

    protected $fillable = [
        "id","agenda_id","nama_kegiatan","poin","mutabaah_id","deleted_at"
    ];

    public function mutabaah(){
    	return $this->belongsTo(Mutabaah::class,'id');
    }
    
}
