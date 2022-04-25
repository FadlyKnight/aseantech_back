<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        'stock',
        'summary',
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function product(){
        return $this->hasOne(Product::class, 'product_detail_id', 'id')->withDefault();
    }
}
