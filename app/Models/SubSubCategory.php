<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_sub_cat_name_eng',
        'sub_sub_cat_slug_eng',
        'sub_sub_cat_name_ban',
        'sub_sub_cat_slug_ban',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'sub_category_id', 'id');
    }
}
