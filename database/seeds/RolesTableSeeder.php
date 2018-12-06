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
                'name'         => 'HieuTruong',
                'display_name' => 'Hiệu trưởng',
                'description'  => 'Hieu truong',

            ]);
            $role->save();
            //End Supper Admin

            //Admin
            $role = new Role([
                'name' => 'GiaoVien',
                'display_name' => 'Giáo viên',
                'description' => 'Giáo viên',
            ]);
            $role->save();
            //End Admin

            //Manager
            $role = new Role([
                 'name' => 'Test(Beta)',
                'display_name' => 'Test(Beta)',
                'description' => ' Test(Beta)',
            ]);
            $role->save();
            //End Manager

        }
    }
}
