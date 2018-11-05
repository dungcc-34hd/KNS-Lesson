<?php


namespace App\Repositories\Role;


use App\Repositories\EloquentRepository;
use App\Role;

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

    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getPages($records,$search = null)
    {
        $total = !is_null($search) ? count($this->_model->where('display_name', 'like', '%' . $search . '%')->get()) : count($this->_model->get());
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
        return is_null($search) ? $this->_model->paginate($records)->items() : $this->_model->where('display_name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate($records)->items();
    }
}