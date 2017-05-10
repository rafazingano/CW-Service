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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->tollFreePhoneNumber,
        'photo' => 'default.jpg',
        'cpf_cnpj' => $faker->numberBetween(11111111111, 9999999999),
        'service_provider' => $faker->randomElement(['y', 'n']),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        'abbr' => $faker->unique()->stateAbbr,
        'title' => $faker->state,
        'slug' => $faker->slug
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'state_id' => App\State::inRandomOrder()->first()->id,
        'title' => $faker->city,
        'slug' => $faker->slug
    ];
});

$factory->define(App\Neighborhood::class, function (Faker\Generator $faker) {
    return [
        'city_id' => App\City::inRandomOrder()->first()->id,
        'title' => $faker->citySuffix,
        'slug' => $faker->slug
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    $neighborhood = App\Neighborhood::inRandomOrder()->first();
    $city = $neighborhood->city()->inRandomOrder()->first();
    $state = $city->state()->inRandomOrder()->first();
    return [
        'state_id' => $state->id,
        'city_id' => $city->id,
        'neighborhood_id' => $neighborhood->id,
        'user_id' => App\User::inRandomOrder()->first()->id,
        'title' => $faker->citySuffix,
        'address' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'complement' => $faker->secondaryAddress,
        'postcode' => $faker->postcode,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});

$factory->define(App\Demand::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'location_id' => App\Location::inRandomOrder()->first()->id,
        'content' => $faker->text,
        'deadline' => $faker->dateTimeBetween('now', '10 days'),
        'who' => $faker->randomElement(['a', 'm'])
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->slug,
        'slug' => $faker->slug,
        'status' => $faker->randomElement(['n', 'y'])
    ];
});