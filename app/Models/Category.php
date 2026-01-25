<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ThemeCategory;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;

    public function  themecategory(){
        return $this->hasMany(ThemeCategory::class);
    }

    public function subcategory(){

        return $this->hasMany(Subcategory::class,'category_id');
   }
}
