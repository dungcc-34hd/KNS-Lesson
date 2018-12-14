<?php

namespace App\Repositories\District;

use App\Models\District;
use App\Models\Province;
use App\Repositories\EloquentRepository;

class DistrictEloquentRepository extends EloquentRepository implements DistrictRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return District::class;
    }
    public $properties='districts.*,areas.name as name_area,districts.name as name_district';

    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getPages($records, $search = null)
    {
        if(!is_null($search)){
             $total = count(District::join('provinces','districts.province_id','=','provinces.id')->join('areas','provinces.area_id','=','areas.id')->where(function ($q) use ($search) {
            $q->where('districts.name', 'like', '%' . $search . '%');
//            $q->orWhere('description', 'like', '%' . $search . '%');
            })->selectRaw($this->properties)->get());
        }else{
            $total=count(District::join('provinces','districts.province_id','=','provinces.id')->join('areas','provinces.area_id','=','areas.id')->selectRaw($this->properties)->get());
        }
         
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
        if(is_null($search)) {
            $result= District::join('provinces','districts.province_id','=','provinces.id')->join('areas','provinces.area_id','=','areas.id')->selectRaw($this->properties)->paginate($records)->items(); 
        }else{
            $result=District::join('provinces','districts.province_id','=','provinces.id')->join('areas','provinces.area_id','=','areas.id')->where(function ($q) use ($search) {
            $q->where('districts.name', 'like', '%' . $search . '%');
//            $q->orWhere('description', 'like', '%' . $search . '%');
            })->selectRaw($this->properties)->paginate($records)->items();
        }
        return $result;
    }

    public function province($areaId){
        return Province::where('area_id','=',$areaId)->get();
    }
}