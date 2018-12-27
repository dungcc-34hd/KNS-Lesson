<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\Province;
use App\Repositories\ManagerArea\ManagerAreaEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class ManagerAreaController extends Controller
{
    protected $repository;

    public function __construct(ManagerAreaEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;


        return view('admin::areas.pagination',
            [
                'areas' => $this->repository->getObjects($per_page, $search),
                'pages' => $this->repository->getPages($per_page, $search),
                'records' => $per_page,
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
        $areas = Area::all();
        $provinces = Province::all();
        $pages = $this->repository->getPages($records);
        return view('admin::managerArea.index', compact('areas', 'pages', 'provinces'));
    }

    /**
     * show a area
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return view('admin::areas.show', compact('area'));
    }

    /**
     * edit a area
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin::areas.edit', compact('area'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        // $this->validation($request, $id);
        $area = Area::findOrFail($id);

        $area->name = $request->name;
        $area->description = $request->description;

        $area->save();
        message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/area/index');
    }

    /**
     * creat a area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createArea()
    {
        return view('admin::managerArea.createArea');
    }

    /**
     * creat a area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createProvince()
    {
        $areas = Area::all();
        return view('admin::managerArea.createProvince', compact('areas'));
    }

    /**
     * creat a area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createDistrict()
    {
        $areas = Area::all();
        $areaId=0;
        $provinces=Province::where('area_id','=',$areaId)->get();
        return view('admin::managerArea.createDistrict', compact('areas', 'provinces'));
    }

    /**
     * store a area
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeArea(Request $request)
    {
        // $this->validation($request, $id = null);
        $area = new Area();
        $area->name = $request->name;
        $area->description = $request->description;
        $area->save();

        message($request, 'success', 'Thêm mới thành công.');
        return redirect('admin/manager-area');
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeProvince(Request $request)
    {
        // $this->validation($request, $id = null);
        $provincial = new Province();
        $provincial->name = $request->name;
        $provincial->area_id = $request->input('area_id');
        $provincial->save();

        message($request, 'success', 'Thêm mới thành công.');
        return redirect('admin/manager-area');
    }

    /**
     * store district
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeDistrict(Request $request)
    {
        // $this->validation($request, $id = null);
        $district = new District();
        $district->name = $request->name;
        $district->province_id = $request->input('province_id');
        $district->save();

        message($request, 'success', 'Thêm mới thành công.');
        return redirect('admin/manager-area');
    }

    /**
     * edit area
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editArea($id)
    {
        $area = Area::find($id);
        return view('admin::managerArea.createArea', compact('area'));
    }

    /**
     * edit province
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editProvince($id)
    {
        $province = Province::find($id);
        $areas = Area::all();
        return view('admin::managerArea.createProvince', compact('province','areas'));
    }

    /**
     * edit area
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editDistrict($id)
    {
        $district =  District::findOrFail($id);
        $provinces =  Province::all();
        $provinceId= Province::where('id','=',$district->province_id)->first();
        $areaId =Area::where('id','=',$provinceId->area_id)->get();
        $areas = Area::all();
        return view('admin::managerArea.createDistrict', compact('district','provinces','areas','areaId','provinceId'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateArea(Request $request, $id)
    {
        // $this->validation($request, $id);
        $area = Area::findOrFail($id);

        $area->name = $request->name;
        $area->description = $request->description;

        $area->save();
        message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/manager-area');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProvince(Request $request, $id)
    {

        $this->validation($request,$id);
        $provincial = Province::findOrFail($id);

        $provincial->name        = $request->name;
        $provincial->area_id        = $request->input('area_id');
        $provincial->save();
        message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/manager-area');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateDistrict(Request $request, $id)
    {
        $this->validation($request,$id);
        $district = District::findOrFail($id);
        $district->name        = $request->name;
        $district->province_id        = $request->input('province_id');
        $district->save();
        message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/manager-area');
    }

    public function deleteArea($id)
    {
        $area = Area::find($id);
        $area->delete();

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');

    }

    public function deleteProvince($id)
    {
        $province = Province::find($id);
        $province->delete();

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');
    }

    public function deleteDistrict($id)
    {
        $district = District::find($id);
        $district->delete();

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');
    }

    // check validate
    public function checkNameArea(Request $rq ,$id){
        if($id<=0){
            $name = Area::where('name',$rq->name)->exists();
          
        }else{
            $name = Area::where('name',$rq->name)->whereNotIn('id',[$rq->id])->exists();
            
        } 
         return response()->json(!$name);
    }

    public function checkNameProvince(Request $rq ,$id){
        if($id<=0){
            $name = Province::where('name',$rq->name)->exists();
          
        }else{
            $name = Province::where('name',$rq->name)->whereNotIn('id',[$rq->id])->exists();
            
        } 
         return response()->json(!$name);
    }

    public function checkNameDistrict(Request $rq ,$id){
        
        if($id<=0){
            $name = District::where('name',$rq->name)->exists();
          
        }else{
            $name = District::where('name',$rq->name)->whereNotIn('id',[$rq->id])->exists();
            
        } 
         return response()->json(!$name);
    }

    //change select option Areas 
     public function changeArea($areaId){
        $array=Province::where('area_id','=',$areaId)->get();;
        return response()->json($array);
    }

}
