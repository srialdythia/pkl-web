<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation
    public function productTypes(){
        return $this->belongsToMany(ProductType::class);
    }
}
