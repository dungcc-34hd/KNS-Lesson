<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\Province;
use App\Repositories\District\DistrictEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class DistrictController extends Controller
{
    protected $repository;
    public function __construct(DistrictEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::districts.pagination',
            [
                'districts' => $this->repository->getObjects($per_page, $search),
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
        $districts =  $this->repository->getObjects($records);
        $pages = $this->repository->getPages($records);
        return view('admin::districts.index', compact('districts','pages'));
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $district = District::findOrFail ($id);
        return view('admin::districts.show',compact('district'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $district =  District::findOrFail($id);
        $provincials =  Province::all();
        return view ('admin::districts.edit', compact('district','provincials'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $provincial = District::findOrFail($id);
        $array = $request->all();
        $this->repository->update($request->id,$array);
         message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/district/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $provincials= Province::all();
        return view('admin::districts.create',compact('provincials'));
    }

    /**
     * store
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $district = new District();
        $district->name        = $request->name;
        $district->province_id	 = $request->input('select-provincial');
        $district->save();

        message($request, 'success', 'Thêm mới thành công.');
        return redirect('admin/district/index');
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

}
