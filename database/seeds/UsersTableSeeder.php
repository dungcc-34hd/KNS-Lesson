<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!DB::table('users')->first()) {
            //supper admin
            $user = new User([
                'name' => 'Supper Administrator',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            $user->save();

            //admin
            $user = new User([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            $user->save();

            //manager
            $user = new User([
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            $user->save();

        }
    }
}
