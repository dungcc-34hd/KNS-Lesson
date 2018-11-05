<?php

namespace App\Repositories\User;

use App\Models\RoleUser;
use App\Repositories\EloquentRepository;
use App\Role;
use App\User;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getPages($records, $search = null)
    {
        $total = !is_null($search) ? count($this->_model->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
            $q->orWhere('email', 'like', '%' . $search . '%');
        })->get()) : count($this->_model->get());
        return ceil($total / $records);
    }

    /**
     * Get all
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getObjects($records, $search = null)
    {
        return is_null($search) ? $this->_model->paginate($records)->items() : $this->_model->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
            $q->orWhere('email', 'like', '%' . $search . '%');
        })->paginate($records)->items();
    }

    /**
     * Get roles
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getRoles()
    {
        return Role::all();
    }

    /**
     * Get role all by user id
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getRoleByUserID($id)
    {
        return $this->_model->find($id)->roles;
    }

    /**
     * Get role all by user id
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function assignRoleForUser($id, $roles)
    {
        RoleUser::where('user_id', '=', $id)->delete();
        foreach ($roles as $role)
        {
            RoleUser::create(['user_id' => $id, 'role_id' => $role, 'user_type' => 'App\User']);
        }
    }
}