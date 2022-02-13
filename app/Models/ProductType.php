<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    // Relationship
    public function productTypeCategories(){
        return $this->belongsToMany(ProductTypeCategory::class,'type_category_combination', 'product_type_id','product_type_category_id')
        ->withTimestamps();
    }
}
