<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_name',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'head_content',
        'status',
    ];
}
