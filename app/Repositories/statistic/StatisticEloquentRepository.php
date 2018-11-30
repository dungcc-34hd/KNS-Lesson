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
         return LsClass::class;
    }
     // public $properties = 'ls_districts.name as name_district';
     // public $properties = 'ls_districts.name as name_district,count(users.id) as a';

    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    

    /**
     * Get all
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getObjects($records,$districtId,$search = null)
    {
      
       
    }

   public function getProvince(){
        return \App\Models\Province::all();
   }

     public function getSchool(){
        return School::all();
   }

   public function getDistricts($provinceId){
        return District::where(['province_id'=> $provinceId])->get();
   }

   
   public function getStatistic($districtId){
         $schools=School::where(['district_id'=> $districtId])->get();
         $sum_teacher=0;
         $sum_student=0;
         foreach ($schools as $key => $school) {
            $schoolId=$school->id;
            $teacher=User::where(['school_id'=>$schoolId])->count('id'); 
             $student=LsClass::where(['school_id'=>$schoolId])->sum('quantity_student');
             $sum_teacher += $teacher; 
             $sum_student  += $student;       
         }
         $array['sum_student']=$sum_student;
         $array['sum_teacher']=$sum_teacher;
         return $array;         
   }

   public function getAccount($schoolId){
        $accounts=User::leftJoin('schools','users.school_id','=' ,'schools.id')->where(['schools.id'=> $schoolId])->count('users.id');
        // dd($accounts);
        return $accounts;
   }


}