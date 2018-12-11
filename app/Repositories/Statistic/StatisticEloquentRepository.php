<?php

namespace App\Repositories\Statistic;


use App\Repositories\EloquentRepository;
use App\Models\LsClass;
use App\Models\District;
use App\Models\School;

use App\Models\Area;
use App\Models\Province;

use App\User;
class StatisticEloquentRepository extends EloquentRepository implements StatisticRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
         return User::class;
    }

   public function getPages($records, $search = null)
    {
        $total = !is_null($search) ? count($this->_model->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
//            $q->orWhere('description', 'like', '%' . $search . '%');
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
//          $q->orWhere('description', 'like', '%' . $search . '%');
        })->paginate($records)->items();
       

    }
    public function area(){
        return \App\Models\Area::all();
    }






   
    


  
    public function getAreaPages($records,$id,$tableID, $search = null)
    {
        $total = !is_null($search) ? 
        count(User::where(function ($q) use ($search) {
        $q->where('name', 'like', '%' . $search . '%')->Where($tableID,$id); })->get()) :
        count( User::where($tableID,$id)->get());
        return ceil($total / $records);
    }

  
    public function getAreaObjects($records,$id,$tableID, $search = null)
    {
        if(is_null($search))
            $User = User::where($tableID,$id)->paginate($records)->items(); 
        else 
            $User= User::where(function ($q) use ($search) { 
                $q->where('name', 'like', '%' . $search . '%')->Where($tableID,$id);
                // $q->orWhere('area_id',$area);
                })->paginate($records)->items();
        
        return $User;
        
       
    }


}