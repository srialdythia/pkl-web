<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['product_type_id','application_type_id','product_type_category_id','requestor_name','business_unit_id','application_date_created','application_no'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'application_product', 'application_id', 'product_id')
        ->withTimestamps();
    }

    public function business(){
        return $this->belongsTo(BusinessUnit::class, 'business_unit_id', 'id');
    }

    public function appType(){
        return $this->belongsTo(ApplicationType::class, 'application_type_id', 'id');
    }

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function productTypeCategory(){
        return $this->belongsTo(ProductTypeCategory::class, 'product_type_category_id', 'id')
        ->withDefault([
            'name' => '-'
        ]);
    }
}
