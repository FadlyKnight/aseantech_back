<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductDetail;
use Faker\Generator as Faker;

$factory->define(ProductDetail::class, function (Faker $faker) {
    return [
        'summary' => $faker->text(100),
        'stock' => $faker->numberBetween(10,100),
        'description' => $faker->text(300)
    ];
});
