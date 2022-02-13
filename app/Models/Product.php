<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_no'];

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'application_product', 'application_id', 'product_id')
        ->withTimestamps();
    }
}
