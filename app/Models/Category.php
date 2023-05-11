<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 */
class Category extends Model
{
    use HasFactory;

    // get parent of category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // get children of category
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function banners(){
        return $this->belongsToMany(Banner::class, 'banner_category');
    }
}