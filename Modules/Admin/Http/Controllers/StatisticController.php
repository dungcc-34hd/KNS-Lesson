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
    protected $areaId;

    public function __construct(StatisticEloquentRepository $repository)
    {
        $this->repository = $repository;
        $this->districtId= 'districtId';
        $this->schoolId='schoolId';
        $this->areaId='areaId';

    }
    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;
        $areaId = session()->has($this->areaId) ? session($this->areaId) : 0;

        return view('admin::user.pagination',
            [
                'users' => $this->repository->getObjects($per_page,$areaId, $search),
                'pages'       => $this->repository->getPages($per_page,$areaId, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }
    public function index()
    {
         $records=10;
        
        $areas=$this->repository->area();
          if(count($areas)>0)
            $areaId = $areas[0]->id;
        // dd($this->repository->getObjects($records,$areaId));
        session([$this->areaId => $areaId]);
        $array=$this->repository->selectArea($areaId);
          

        return view('admin::statistic.index',
        [
            'users' => $this->repository->getObjects($records,$areaId),
            'pages'       => $this->repository->getPages($records,$areaId),
            'areas'=>$areas,
            'provinces'=> $array['provinces'],
            'districts'=> $array['districts'],
            'schools'=> $array['schools'],
         
        ]);
        
    }

    public function changeArea($areaId){
        session([$this->areaId => $areaId]);
        // dd(session()->has($this->areaId) ? session($this->areaId) : 0);
        $array=$this->repository->selectArea($areaId);
        return response()->json($array);

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
    public function changeSelect($areaId,$provinceId=null){
        $array=$this->repository->select($areaId,$provinceId = null);
        return response()->json($array);
    }
}
