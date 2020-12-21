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
//        $this->call(CountriesTableSeeder::class);
        $this->call(Countries::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RealEstateTableSeeder::class);

    }
}
