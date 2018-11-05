<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!DB::table('roles')->first()) {

            //Supper Admin
            $role = new Role([
                'name'         => 'super-admin',
                'display_name' => 'Supper Administrator',
                'description'  => 'Full controller',
            ]);
            $role->save();
            //End Supper Admin

            //Admin
            $role = new Role([
                'name'         => 'admin',
                'display_name' => 'Administrator',
            ]);
            $role->save();
            //End Admin

            //Manager
            $role = new Role([
                'name'         => 'manager',
                'display_name' => 'Manager',
            ]);
            $role->save();
            //End Manager

        }
    }
}
