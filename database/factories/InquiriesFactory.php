<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Inquiry;
use App\Product;
use phpDocumentor\Reflection\Types\Null_;

$factory->define(Inquiry::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->name,
        'last_name'     => $faker->name,
        'email'         => $faker->unique()->safeEmail,
        'phone'         => $faker->regexify('[0-9]{10}'),
        'message'       => $faker->paragraph,
        'reply'         => $faker->paragraph,
        'product_id'    => Product::count() !=0 ? Product::inRandomOrder()->first()->id : null,
        'status'        => 1,
    ];
});
