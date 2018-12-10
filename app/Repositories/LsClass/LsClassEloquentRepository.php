<?php

namespace App\Repositories\LsClass;

use App\Models\LsClass;
use App\User;
use App\Models\Grade;
use App\Repositories\EloquentRepository;

class LsClassEloquentRepository extends EloquentRepository implements LsClassRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return LsClass::class;
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
        })->paginate($records)->items();
    }
}