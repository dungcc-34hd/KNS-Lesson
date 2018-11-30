<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\Statistic\StatisticEloquentRepository;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $repository;
    protected $districtId;
    protected $schoolId;

    public function __construct(StatisticEloquentRepository $repository)
    {
        $this->repository = $repository;
        $this->districtId= 'districtId';
        $this->schoolId='schoolId';

    }
    public function index()
    {
         $records=10;
        $provinces=$this->repository->getProvince();    
        $provinceId = 0;
        if(count($provinces)>0)
            $provinceId = $provinces[0]->id;

        $districts=$this->repository->getDistricts($provinceId);
        $districtId=count($districts) > 0 ? $districts->first()->id : 0;
       // foreach ($districts as $key => $district) {
       //     $districtId=$district->id;
        // $as=$this->repository->getObjects($records,$districtId, $search = null);
     
        $array=$this->repository->getStatistic($districtId);

        $schools=$this->repository->getSchool();
        $schoolId=0;
        if(count($schools)>0)
            $schoolId = $schools[0]->id;
        $accounts=$this->repository->getAccount($schoolId);
        // dd($accounts);
        
        $sum_teacher=$array['sum_teacher'];
        $sum_student=$array['sum_student'];
        
        session([$this->districtId => $districtId]);

        return view('admin::statistic.index',
        [
            'provinces'=>$provinces,
            'districts' =>  $districts,
            'schools'   => $this->repository->getSchool(),
            'sum_teacher'=> $sum_teacher,
            'sum_student'=> $sum_student,
            'accounts'=>$accounts,

        ]);
        // $provincial_id=1;
        // $array=$this->repository->getStatistic($provincial_id);
        // dd($array);
    }

    public function changeProvince($provinceId){
        $array=$this->repository->getDistricts($provinceId);
        return response()->json($array);

    }
    public function changeDistrict($districtId){
          // session([$this->districtId => $districtId]);
        $array=$this->repository->getStatistic($districtId);
        return response()->json($array);
    }

    public function changeSchool($schoolId){
        $array=$this->repository->getAccount($schoolId);
        return response()->json($array);
    }
}
