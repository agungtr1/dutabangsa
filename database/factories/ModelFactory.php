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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Peserta::class, function (Faker\Generator $faker) {
    static $password;

    // $latarbelakang = randomElements($array = array ('bekerja','kuliah','sekolah');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        /*'nama' => $faker->name,
        'nis' => $faker->ean8,
        'nohp' => $faker->phoneNumber,
        'email' => $faker->email,
        'latarbelakang' => $latarbelakang,
        'tanggalpelaksanaan' => $faker->dateTime,*/
    ];
});
