<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans=[
            array('title'=>'Try Now','name'=>'Personal','period'=>'1','price'=>10),
            array('title'=>'Most Popular','name'=>'Professional','period'=>'6','price'=>26),
            array('title'=>'Full Featured','name'=>'Enterprise','period'=>'12','price'=>49)
        ];
        \App\Models\Plan::insert($plans);
    }
}
