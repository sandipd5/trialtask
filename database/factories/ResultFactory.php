<?php

use Faker\Generator as Faker;
use App\Result;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Result::class, function (Faker $faker) {

    return [
        
        'name' => $faker->name,
        'faculty' => $faker->name,
        'subject' => $faker->name,
        'total_marks' => 100,
        'obtained_marks' => $faker->numberBetween($min = 100, $max = 0),
        'remarks' => $faker->name,
    ];
    
});
