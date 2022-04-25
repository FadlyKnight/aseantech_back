<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $price = rand(100,400).'.00';
    static $increment = 1;
    return [
        'product_detail_id' => $increment++,
        'category_id' => $faker->numberBetween(1,5),
        'name' => $faker->name(),
        'price' => $price
    ];
});
