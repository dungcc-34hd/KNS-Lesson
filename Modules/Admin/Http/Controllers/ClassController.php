<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\User;
use App\Models\District;
use App\Models\Grade;
use App\Models\LsClass;
use App\Models\School;
use App\Models\SchoolLevel;
use App\Repositories\LsClass\LsClassEloquentRepository;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class ClassController extends Controller
{ 
    protected $repository;
    public function __construct(LsClassEloquentRepository $repository)
    {
        $this->repository = $repository;
      
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::class.pagination', 
            [
                'class' => $this->repository->getObjects($per_page, $search),
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
        $class =  $this->repository->getObjects($records);
        $pages = $this->repository->getPages($records);
        return view('admin::class.index', compact('class','pages'));
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $class          = LsClass::findOrFail ($id);
        $grade_id=$class->grade_id;
        $grade    = Grade::find($grade_id);
        return view('admin::class.show',compact('class','grade'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $class          =  LsClass::findOrFail($id);
        $gradeLevels    =  Grade::all();
        return view ('admin::class.edit', compact('class','gradeLevels'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $array = $request->all();
        $this->repository->update($id,$array);   
        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Cập nhật thành công');
        

        return redirect('admin/class/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $gradeLevels  =  Grade::all();
        return view('admin::class.create',compact('gradeLevels'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $array=$request->all();
        $this->repository->create($array);

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Tạo mới thành công');
        
        return redirect('admin/class/index');
    }

    public function delete($id)
    {
        $class = LsClass::findOrFail($id);

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');

        $class->delete();
    }

}
