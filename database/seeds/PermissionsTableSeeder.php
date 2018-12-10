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
                'name' => 'FullKhoi',
                'display_name' => 'Full khối',
                'description' => 'Full Khối',
                'type' => 'CRUD',
            ]);
            $permission->save();

            $permission = new \App\Permission([
                'name' => 'TheoKhoi',
                'display_name' => 'Theo Khối',
                'description' => 'Theo Khối',
                'type' => 'CRUD',
            ]);
            $permission->save();

            $permission = new \App\Permission([
                'name' => 'Beta',
                'display_name' => 'Beta',
                'description' => ' Beta',
                'type' => 'CRUD',
            ]);
            $permission->save();

            // $permission = new \App\Permission([
            //     'name' => 'delete',
            //     'display_name' => 'Delete',
            //     'description' => 'Delete Object',
            //     'type' => 'CRUD',
            // ]);
            // $permission->save();

            // //End CRUD


        }
    }
}
