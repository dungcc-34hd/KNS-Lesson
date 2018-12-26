<?php


namespace App\Repositories\Role;


use App\Repositories\EloquentRepository;
use App\Role;
use App\Permission;


class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
       return Role::class;
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
            $total = count(Role::Join('permission_role','roles.id','=','permission_role.role_id')->JOIN('permissions','permission_role.permission_id','=','permissions.id')->where('roles.display_name', 'like', '%' . $search . '%')->orwhere('roles.name', 'like', '%' . $search . '%')->selectRaw($this->properties)->get());
        }else{
            $total= count(Role::Join('permission_role','roles.id','=','permission_role.role_id')->JOIN('permissions','permission_role.permission_id','=','permissions.id')->selectRaw($this->properties)->get());
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
        if( is_null($search)){
                $results= Role::Join('permission_role','roles.id','=','permission_role.role_id')->JOIN('permissions','permission_role.permission_id','=','permissions.id')->selectRaw($this->properties)->paginate($records)->items();
            }else{
                $results= Role::Join('permission_role','roles.id','=','permission_role.role_id')->JOIN('permissions','permission_role.permission_id','=','permissions.id')->where('roles.display_name', 'like', '%' . $search . '%')->orwhere('roles.name', 'like', '%' . $search . '%')->selectRaw($this->properties)->paginate($records)->items();
            }
              
             return $results;
    }
      public function getPermission(){
        return \App\Permission::all();
    }
    
    public function getRole($id){
        return Permission::Join('permission_role','permissions.id','=','permission_role.permission_id')->JOIN('roles','permission_role.role_id','=','roles.id')->where('roles.id', '=',$id)->selectRaw($this->properties)->get();
    }
}