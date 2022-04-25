<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'summary',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function product(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
