<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\Province;
use App\Models\District;
use App\Models\School;
use App\Models\SchoolLevel;
use App\Repositories\School\SchoolEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class SchoolController extends Controller
{
    protected $repository;
    protected $areaId;
    public function __construct(SchoolEloquentRepository $repository)
    {
        $this->repository = $repository;
        $this->areaId     = 'areaId';
        $this->provinceId='provinceId';
        $this->districtId     = 'districtId';

    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;
         $areaId = session()->has($this->areaId) ? session($this->areaId) : 0;

        return view('admin::schools.pagination',
            [
                'schools' => $this->repository->getObjects($per_page, $search),
                'pages'       => $this->repository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = 10;
         $areas    =  Area::all();
         $areaId=0;
        $array=$this->repository->changeArea($areaId);
        return view('admin::schools.index',[
            'schools' =>  $this->repository->getObjects($records),
            'pages' => $this->repository->getPages($records),
            'areas'=> $areas,
            'provinces'=>$array['provinces'],
            'districts'=>$array['districts'],
            'schoolLevels' => SchoolLevel::all(),
        ]);
       
    }
 public function select(){
        $records=10;
        $data        = $this->repository->getObjects($records);
         $user           = $this->returnTr($data);
         return response()->json(['user'=>$user]); 
    }
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
     public function hanldingDistrict(Request $req)
    {
       
        $records        =10;
        $district_id    = $req->district;
        $Users          = $this->repository->getAreaObjects($records,$district_id ,'district_id');
        $page           = $this->repository->getAreaPages($records,$district_id ,'district_id');        
       
        $user           = $this->returnTr($Users);

        return response()->json(['user'=>$user]);    
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
                <td>".$user->schoolLevel['name']."</td>
                <td>".$user->area['name']."</td>
                <td>".$user->province['name']."</td>
                <td>".$user->district['name']."</td>
                <td>".$user->license_key."</td>
               
                <td> <div class='btn-group btn-group-sm'>
                <a class='btn btn-success' href='/admin/school/show/".$user->id."' title='Detail'>
                <i class='fa fa-eye'></i>
                </a>
                <a class='btn btn-info' href='/admin/school/edit/".$user->id."' title='Edit'>
                <i class='ace-icon fa fa-pencil'></i>
                </a>
                <a href='' class='btn btn-danger delete-object' title='Delete' object_id='".$user->id."' object_name='".$user->name."'>
                <i class='fa fa-trash-o'></i>
                </a>
                </div></td>
                </tr>";
                array_push($arrayUser, $option);
            }
       
        }else{
            $option = "<tr> <td colspan='9'>Không có bản ghi nào</td> </tr>";
            array_push($arrayUser, $option);
        }
        $user  = implode(" ",$arrayUser);

        return $user;
 
    }





    public function changeArea($areaId){
       session([$this->areaId => $areaId]);
        $array=$this->repository->changeArea($areaId);
        return response()->json($array);
    }
    public function changeProvince($provinceId){
        $array=$this->repository->changeProvince($provinceId);
        return response()->json($array);
    }
    public function changeDistrict($districtId){
        $array=$this->repository->changeDistrict($districtId);
        return response()->json($array);
    }


    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $school = School::findOrFail ($id);
        return view('admin::schools.show',compact('school'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
      
      
        $areas    =  Area::all();
        return view('admin::schools.edit',[
            'school' => School::findOrFail($id),
            'areas'=> $areas,
            'provinces'=>Province::all(),
            'districts'=>District::all(),
            'schoolLevels' => SchoolLevel::all(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
       
        $array = $request->all();
        $this->repository->update($request->id, $array);
        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Cập nhật thành công');

        return redirect('admin/school/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function create()
    {  
        $areas    =  Area::all();
        count($areas) >0 ? $areaId=$areas[0]->id : $areaId=0;
        $array=$this->repository->changeArea($areaId);
        
        return view('admin::schools.create',[
            'areas'=> $areas,
            'provinces'=>$array['provinces'],
            'districts'=>$array['districts'],
            'schoolLevels' => SchoolLevel::all(),
        ]);
        
    }
    

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $array = $request->all();
            $array['quantity_account']=99;
            $array['license_key']=$this->SimpleRandString();
            $this->repository->create( $array);
            message($request, 'success', 'Tạo mới thành công.');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.school.index');

    }

    public function delete($id)
    {
        try
        {
              
            $this->repository->delete($id);
            Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');
       
            
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            return response()->json(['status' => false]);
        }


        
    }

    public function SimpleRandString($length=32, $list="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"){

        mt_srand((double)microtime()*1000000);
        $newstring="";

        if($length>0){

            while(strlen($newstring)<$length){
                $newstring.=$list[mt_rand(0, strlen($list)-1)];
            }
        }

        return $newstring;

    }

   
}
