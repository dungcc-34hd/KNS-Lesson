<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
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
    public function changeArea($areaId){
       
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
        count($areas) >0 ? $areaId=$areas[0]->id : $areaId=0;
        $array=$this->repository->changeArea($areaId);
        return view('admin::schools.edit',[
            'school' => School::findOrFail($id),
            'areas'=> $areas,
            'provinces'=>$array['provinces'],
            'districts'=>$array['districts'],
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
        Session::flash('flash_message', 'Tạo mới thành công');

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
            $array['license_key']= $this->SimpleRandString();
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
        $school = School::findOrFail($id);
        $school->delete();

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');
        
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
