<?php

namespace App\Repositories\Permission;

use App\Repositories\EloquentRepository;
use \App\Permission;
use App\Role;

class PermissionEloquentRepository extends EloquentRepository implements PermissionRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Permission::class;
    }
    public $properties = 'permissions.name as name_permission,  permission_role.permission_id as permission_id,  permission_role.role_id as role_id, roles.name as name_role,  roles.display_name as display_role,  roles.description as description_role, roles.id as role_id';
    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getPages($records,$search = null)
    {
        if(!is_null($search)){
            $total = count(Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->where('roles.display_name', 'like', '%' . $search . '%')->selectRaw($this->properties)->get());
        }else{
            $total= count(Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->selectRaw($this->properties)->get());
        }
       
        return ceil($total/$records);
    }

    /**
     * Get all
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getObjects($records, $search = null)
    {
        // $results= is_null($search) ? ->paginate($records)->items() : $this->_model->where('display_name', 'like', '%' . $search . '%')
        //     ->orWhere('description', 'like', '%' . $search . '%')
        //     ->paginate($records)->items();
            if( is_null($search)){
                $results= Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->selectRaw($this->properties)->paginate($records)->items();
            }else{
                $results=  Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->where('roles.display_name', 'like', '%' . $search . '%')->selectRaw($this->properties)->paginate($records)->items();
            }
              
             return $results;
    }

    public function getPermission(){
        return Permission::all();
    }
    
    public function getRole($id){
        return Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->where('roles.id', '=',$id)->selectRaw($this->properties)->get();
    }
}