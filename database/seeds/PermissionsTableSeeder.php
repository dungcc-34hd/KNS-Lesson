<?php

use App\User;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!DB::table('permissions')->first()) {

            //CRUD
            $permission = new \App\Permission([
                'name' => 'read',
                'display_name' => 'Read',
                'description' => 'Read Lists',
                'type' => 'CRUD',
            ]);
            $permission->save();

            $permission = new \App\Permission([
                'name' => 'create',
                'display_name' => 'Create',
                'description' => 'Create Object',
                'type' => 'CRUD',
            ]);
            $permission->save();

            $permission = new \App\Permission([
                'name' => 'edit',
                'display_name' => 'Edit',
                'description' => 'Edit Object',
                'type' => 'CRUD',
            ]);
            $permission->save();

            $permission = new \App\Permission([
                'name' => 'delete',
                'display_name' => 'Delete',
                'description' => 'Delete Object',
                'type' => 'CRUD',
            ]);
            $permission->save();

            //End CRUD


        }
    }
}
