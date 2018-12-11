<?php

namespace App\Repositories\School;

use App\Models\School;
use App\Models\Area;
use App\Models\Province;
use App\Models\District;
use App\Repositories\EloquentRepository;

class SchoolEloquentRepository extends EloquentRepository implements SchoolRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return School::class;
    }
    public $properties='schools.*,areas.name as name_area,provinces.name as name_province, districts.name as name_district,school_levels.name as name_level';
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

    public function changeArea($areaId){  
         $provinces=Province::where('area_id' , '=',$areaId)->get();
         count($provinces)>0 ? $provinceId=$provinces[0]->id : $provinceId=0;
         $districts=District::where('province_id','=',$provinceId)->get();
         $data=School::join('areas','schools.area_id','=','areas.id')->join('provinces','schools.province_id','=','provinces.id')->join('districts','schools.district_id','=','districts.id')->join('school_levels','schools.school_level_id','=','school_levels.id')->where('schools.area_id' , '=',$areaId)->selectRaw($this->properties)->get();
         $array['data']=$data;
         $array['provinces']=$provinces;
         $array['districts']=$districts;
        return $array;

    }
    public function changeProvince($provinceId){
        $districts=District::where('province_id','=',$provinceId)->get();
        $data=School::join('areas','schools.area_id','=','areas.id')->join('provinces','schools.province_id','=','provinces.id')->join('districts','schools.district_id','=','districts.id')->join('school_levels','schools.school_level_id','=','school_levels.id')->where('schools.province_id' , '=',$provinceId)->selectRaw($this->properties)->get();
         $array['data']=$data;
         $array['districts']=$districts;
        return $array;
    }
    public function changeDistrict($districtId){
       
        return School::join('areas','schools.area_id','=','areas.id')->join('provinces','schools.province_id','=','provinces.id')->join('districts','schools.district_id','=','districts.id')->join('school_levels','schools.school_level_id','=','school_levels.id')->where('schools.district_id' , '=',$districtId)->selectRaw($this->properties)->get();
        
    }
}