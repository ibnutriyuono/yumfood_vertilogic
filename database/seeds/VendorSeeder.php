<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Vendor::class, 50)->states([
            'random-cost',
            'randoms-cuisine',
            'is-halal',
            'randoms-meal-of-the-day',
            'random-meat-fish'
        ])->create();
    }
}
