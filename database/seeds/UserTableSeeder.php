<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            array(
                'name'  =>'Dev Hatem',
                'email' =>'admin@app.com',
                'phone' =>'01090703457',
                'image' =>'uploads/users/default-user.png',
                'role'  =>'admin',
                'status'=>'unblocked',
                'password'=>\Illuminate\Support\Facades\Hash::make(12345678),
                'plan_id' =>null,
                'plan_starting_date'=>null,
                'created_at'=>now()
            ),
            array(
                'name'  =>'owner',
                'email' =>'owner@app.com',
                'phone' =>'01099445565',
                'image' =>'uploads/users/default-user.png',
                'role'  =>'owner',
                'status'=>'unblocked',
                'password'=>\Illuminate\Support\Facades\Hash::make(12345678),
                'plan_id' =>1,
                'plan_starting_date'=>now(),
                'created_at'=>now()
            ),
            array(
                'name'  =>'customer',
                'email' =>'customer@app.com',
                'phone' =>'01122368514',
                'image' =>'uploads/users/default-user.png',
                'role'  =>'customer',
                'status'=>'unblocked',
                'password'=>\Illuminate\Support\Facades\Hash::make(12345678),
                'plan_id' =>null,
                'plan_starting_date'=>null,
                'created_at'=>now()
            ),
        ];
        \App\Models\User::insert($users);
    }
}
