<?php

namespace App\Repositories\Statistic;


use App\Repositories\EloquentRepository;
use App\Models\LsClass;
use App\Models\District;
use App\Models\School;
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
    public $properties='users.*,areas.name as name_area,provinces.name as name_province, districts.name as name_district, schools.name as name_school, class.name as name_class, grades.name as name_grade, roles.display_name as name_role';

   public function getPages($records,$areaId, $search = null)
    {
        if(!is_null($search)){
            $total=count(User::join('areas','users.area_id','=','areas.id')->join('provinces','users.province_id','=','provinces.id')->join('districts','users.district_id','=','districts.id')->join('schools','users.school_id','=','schools.id')->join('class','users.class_id','=','class.id')->join('grades','users.grade_id','=','grades.id')->join('roles','users.role_id','=','roles.id')->where(function ($q) use ($search,$areaId) {
                $q->where('users.area_id','=',$areaId);
                $q->where('users.name', 'like', '%' . $search . '%');
                $q->orWhere('users.email', 'like', '%' . $search . '%');
                })->selectRaw($this->properties)->get());

        }else{
            $total=count(User::join('areas','users.area_id','=','areas.id')->join('provinces','users.province_id','=','provinces.id')->join('districts','users.district_id','=','districts.id')->join('schools','users.school_id','=','schools.id')->join('class','users.class_id','=','class.id')->join('grades','users.grade_id','=','grades.id')->join('roles','users.role_id','=','roles.id')->where('users.area_id','=',$areaId)->selectRaw($this->properties)->get());
        }
        return ceil($total / $records);
    }

    /**
     * Get all
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getObjects($records,$areaId, $search = null)
    {
        if(is_null($search)){
            $resulut= User::join('areas','users.area_id','=','areas.id')->join('provinces','users.province_id','=','provinces.id')->join('districts','users.district_id','=','districts.id')->join('schools','users.school_id','=','schools.id')->join('class','users.class_id','=','class.id')->join('grades','users.grade_id','=','grades.id')->join('roles','users.role_id','=','roles.id')->where('users.area_id','=',$areaId)->selectRaw($this->properties)->paginate($records)->items();
            // dd($resulut);
        }else{
            $resulut= User::join('areas','users.area_id','=','areas.id')->join('provinces','users.province_id','=','provinces.id')->join('districts','users.district_id','=','districts.id')->join('schools','users.school_id','=','schools.id')->join('class','users.class_id','=','class.id')->join('grades','users.grade_id','=','grades.id')->join('roles','users.role_id','=','roles.id')->where(function ($q) use ($search,$areaId) {
                $q->where('users.area_id','=',$areaId);
                $q->where('users.name', 'like', '%' . $search . '%');
                $q->orWhere('users.email', 'like', '%' . $search . '%');
                })->selectRaw($this->properties)->paginate($records)->items();
        }
        return $resulut;
    }
    public function area(){
        return \App\Models\Area::all();
    }

    // public function select($areaId,$provinceId = null){
    //     if(is_null($provinceId)){
    //         $provinces=\App\Models\Province::where('area_id','=',$areaId)->get();
      
    //        if(count($provinces)>0){
    //             $provinceId=$provinces[0]->id;
    //         }
    //         $districts=\App\Models\District::where('province_id','=',$provinceId)->get();
    //          if(count($districts)>0){
    //             $districtId=$districts[0]->id;
    //         }
    //         // $schools=\App\Models\School::where('district_id','=',$districtId)->get();
    //         $array['provinces']=$provinces;
    //         $array['districts']=$districts;
    //         // $array['schools']=$schools;
    //     }else{
    //         $districts=\App\Models\District::where('province_id','=',$provinceId)->get();
    //         $array['districts']=$districts;
    //     }
       
    //     return $array;
    // }
    public function selectArea($areaId){
        // $data= User::join('areas','users.area_id','=','areas.id')->join('provinces','users.province_id','=','provinces.id')->join('districts','users.district_id','=','districts.id')->join('schools','users.school_id','=','schools.id')->join('class','users.class_id','=','class.id')->join('grades','users.grade_id','=','grades.id')->join('roles','users.role_id','=','roles.id')->where('users.area_id','=',$areaId)->selectRaw($this->properties)->get();
        // dd($data);
         $provinces=\App\Models\Province::where('area_id','=',$areaId)->get();    
           if(count($provinces)>0){
                $provinceId=$provinces[0]->id;
            }
            $districts=\App\Models\District::where('province_id','=',$provinceId)->get();
            // dd($districts);
             if(count($districts)>0){
                $districtId=$districts[0]->id;
            }
            $schools=\App\Models\School::where('district_id','=',$districtId)->get();
            $array['provinces']=$provinces;
            $array['districts']=$districts;
            $array['schools']=$schools;
            // $array['data']=$data;
            return $array;
    }
    public function district($provinceId){
        $districts=\App\Models\District::where('province_id','=',$provinceId)->get();
         if(count($districts)>0){
            $districtId=$districts[0]->id;
        }
        $schools=\App\Models\School::where('district_id','=',$districtId)->get();
        $array['districts']=$districts;
        $array['schools']=$schools;
        return $array;
       
    }
    public function school($districtId){
        return \App\Models\School::where('district_id','=',$districtId)->get();;
    }
    


   // public function getProvince(){
   //      return \App\Models\Province::all();
   // }

   //   public function getSchool(){
   //      return School::all();
   // }

   // public function getDistricts($provinceId){
   //      return District::where(['province_id'=> $provinceId])->get();
   // }

   
   // public function getStatistic($districtId){
         // $schools=School::where(['district_id'=> $districtId])->get();
         // $sum_teacher=0;
         // $sum_student=0;
         // foreach ($schools as $key => $school) {
         //    $schoolId=$school->id;
         //    $teacher=User::where(['school_id'=>$schoolId])->count('id'); 
         //     $student=LsClass::where(['school_id'=>$schoolId])->sum('quantity_student');
         //     $sum_teacher += $teacher; 
         //     $sum_student  += $student;       
         // }
         // $array['sum_student']=$sum_student;
         // $array['sum_teacher']=$sum_teacher;
         // return $array;         
   // }

   // public function getAccount($schoolId){
   //      $accounts=User::leftJoin('schools','users.school_id','=' ,'schools.id')->where(['schools.id'=> $schoolId])->count('users.id');
   //      // dd($accounts);
   //      return $accounts;
   // }


}