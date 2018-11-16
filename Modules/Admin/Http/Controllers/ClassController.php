<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\GradeLevel;
use App\Models\LsClass;
use App\Models\School;
use App\Models\SchoolLevel;
use App\Repositories\LsClass\LsClassEloquentRepository;
use App\User;
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

        return view('admin::user.pagination',
            [
                'users' => $this->repository->getObjects($per_page, $search),
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
        $class =  LsClass::all();
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
        $class = LsClass::findOrFail ($id);
        return view('admin::class.show',compact('class'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $class      =  LsClass::findOrFail($id);
        $gradeLevels =  GradeLevel::all();
        $schools    = School::all();
        return view ('admin::class.edit', compact('class','gradeLevels','schools'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $class = LsClass::findOrFail($id);

        $class->name               = $request->name;
        $class->grade_level_id     = $request->input('select-grade-level');
        $class->school_id        = $request->input('select-school');
        $class->quantity_student   = $request->quantity;
        $class->save();

        Session::flash('message', 'Successfully updated provincial!');
        return redirect('admin/class/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $schools    =  School::all();
        $gradeLevels =  GradeLevel::all();
        return view('admin::class.create',compact('schools','gradeLevels'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $class = new LsClass();

        $class->name               = $request->name;
        $class->grade_level_id     = $request->input('select-grade-level');
        $class->school_id        = $request->input('select-school');
        $class->quantity_student   = $request->quantity;
        $class->save();

        Session::flash('message', 'Successfully created provicial!');
        return redirect('admin/class/index');
    }

    public function delete($id)
    {
        $class = LsClass::findOrFail($id);
        $class->delete();
    }

}
