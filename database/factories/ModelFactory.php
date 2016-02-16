<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'admin',
        'email' => 'admin',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Post::class, function ($faker) {
    return [
        'title' => $faker->sentence(mt_rand(3, 10)),
        'content' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'read'=>random_int(10,30),
        'comment'=>0,
        'author'=>config('blog.author'),
        'archive'=>'未分类',
    ];
});
$factory->define(App\Archive::class,function($faker){
    return [
        'name'=>'未分类',
        'counts'=>0,
        'slug'=>'default'
    ];
});