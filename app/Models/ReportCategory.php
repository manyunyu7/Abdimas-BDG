<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
    use HasFactory;
    protected $table = "report_categories";
    protected $fillable = [
        "category_name",
        "photo_path",
    ];
}
