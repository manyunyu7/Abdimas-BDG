<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";

    protected $fillable=[
        "title",
        "author",
        "cover_link",
        "further_link",
        "content",
        "created_at",
        "updated_at",
    ];
}
