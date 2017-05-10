<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 30)->create();
        //$states = factory(App\State::class, 12)->create();
        //$cities = factory(App\City::class, 42)->create();
        //$neighborhoods = factory(App\Neighborhood::class, 82)->create();
        factory(App\Location::class, 132)->create();
        factory(App\Demand::class, 42)->create();
        factory(App\Tag::class, 42)->create();
    }
}
