<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','kamal@gmail.com')->first(); // get one user but if we use get() function then get collection of user

        if(!$user){ // if user is not founded
        User::create([
            'name' => 'kamal',
            'email' => 'kamal@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);
        }
    }
}
