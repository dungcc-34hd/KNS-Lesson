<?php

namespace Modules\Admin\Http\Controllers;


use App\Models\Area;
use App\Models\LsClass;
use App\Models\District;
use App\Models\School;
use App\Models\Province;

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



    public function __construct(StatisticEloquentRepository $repository)
    {
        $this->repository = $repository;


    }
    public function pagination(Request $request, $records, $search = null)
    {

        $per_page   = is_null($records) ? 10 : $records;
        $areas      = Area::all();

        return view('admin::statistic.pagination', 
            [
                'users'             => $this->repository->getObjects($per_page, $search),
                'pages'             => $this->repository->getPages($per_page, $search),
                'records'           => $per_page,
                'currentPage'       => $request->page,
                'areas'             => $areas
            ]);
    }


    public function index()
    {
         $records=10;
        

    
          
        $areas = Area::all();
        return view('admin::statistic.index',
        [
            'users'             => $this->repository->getObjects($records),
            'pages'             => $this->repository->getPages($records),
            'areas'             => $areas    

        ]);
        
    }


  
     /**
     * hanlding ajax for Area reutrn provinces
     * @author thanh
     * @date 4/12/2018
     * @param  Request $request
     * @return view
     */
    public function hanldingArea(Request $req)
    {
        $title          = "Chọn Tỉnh";
        $records        =10;
        $area_id        = $req->area;
        $Users          = $this->repository->getAreaObjects($records,$area_id,'area_id');
        $page           = $this->repository->getAreaPages($records,$area_id,'area_id');
        $provinces      = Province::where('area_id',$area_id)->get();
        
        $select         = $this->returnOption($provinces,$title );

        $user           = $this->returnTr($Users);
        
        return response()->json(['select' => $select,'user'=>$user]);  
    }

     /**
     * hanlding ajax for Province reutrn district
     * @author thanh
     * @date 4/12/2018
     * @param  Request $request
     * @return view
     */
    public function hanldingProvince(Request $req)
    {
        $title          = "Chọn Quận/Huyện";
        $records        =10;
        $province_id    = $req->province;
        $Users          = $this->repository->getAreaObjects($records,$province_id ,'province_id');
        $page           = $this->repository->getAreaPages($records,$province_id ,'province_id');
        $districts      = District::where('province_id',$province_id )->get();
        
        $select         = $this->returnOption($districts,$title );
        $user           = $this->returnTr($Users);

        return response()->json(['select' => $select,'user'=>$user]);  
    }

      /**
     * hanlding ajax for Province reutrn district
     * @author thanh
     * @date 4/12/2018
     * @param  Request $request
     * @return view
     */
    public function hanldingDistrict(Request $req)
    {
        $title          = "Chọn Trường";
        $records        =10;
        $district_id    = $req->district;
        $Users          = $this->repository->getAreaObjects($records,$district_id ,'district_id');
        $page           = $this->repository->getAreaPages($records,$district_id ,'district_id');
        $school         = School::where('district_id',$district_id)->get();
        
        $select         = $this->returnOption($school,$title );
        $user           = $this->returnTr($Users);

        return response()->json(['select' => $select,'user'=>$user]);    
    }
    
    public function hanldingSchool(Request $req)
    {

        $records        = 10;
        $school_id      = $req->school;
        $Users          = $this->repository->getAreaObjects($records,$school_id ,'school_id');
        $page           = $this->repository->getAreaPages($records,$school_id ,'school_id');

        $user           = $this->returnTr($Users);

        return response()->json(['user' => $user]);  
    }



    // return json
    public function returnOption($provinces,$title){
        $arrayOption = array("<option value='' >$title</option>");
        foreach ($provinces as  $value) {
            $option = "<option value='".$value->id."'>".$value->name."</option>";
            array_push($arrayOption, $option);
        }
        $select = implode(" ",$arrayOption);
        return $select;
    }
    public function returnTr($Users){
        
        $arrayUser      =  array();
        if($Users!=null){
            foreach ($Users as $key =>  $user) {
                $key = $key+1;
                $option = " 
                <tr>
                <td >".$key."</td>
                <td>".$user->name."</td>
                <td>".$user->area['name']."</td>
                <td>".$user->province['name']."</td>
                <td>".$user->district['name']."</td>
                <td>".$user->school['name']."</td>
                <td>".$user->grade['name']."</td>
                <td>".$user->lsClass['name']."</td>
                <td>".$user->quantity_student."</td>
                </tr>";
                array_push($arrayUser, $option);
            }
       
        }else{
            $option = "<tr> <td colspan='9'>No Records</td> </tr>";
            array_push($arrayUser, $option);
        }
        $user  = implode(" ",$arrayUser);

        return $user;
 
    }
    
    

}
