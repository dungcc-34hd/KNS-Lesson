<?php

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!DB::table('role_user')->first()) {

            $role = new RoleUser([
                'role_id' => 1,
                'user_id' => 1,
                'user_type' => 'App\User'
            ]);
            $role->save();

            $role = new RoleUser([
                'role_id' => 2,
                'user_id' => 2,
                'user_type' => 'App\User'
            ]);
            $role->save();

            $role = new RoleUser([
                'role_id' => 3,
                'user_id' => 3,
                'user_type' => 'App\User'
            ]);
            $role->save();

        }
    }
}
