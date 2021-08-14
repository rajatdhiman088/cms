<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','rajatdhiman782@gmail.com')->first();

        if(!$user)
        {
            $user=User::create([
                'name'=>'rajat',
                'email'=>'rajatdhiman782@gmail.com',
                'role'=>'admin',
                'password'=>Hash::make('12345678'),
            ]);
        }
        
    }
}
