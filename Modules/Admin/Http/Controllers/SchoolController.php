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
        $schools =  School::all();
        $pages = $this->repository->getPages($records);
        return view('admin::schools.index', compact('schools','pages'));
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
        $school =  School::findOrFail($id);
        $districts =  District::all();
        $schoolLevels =  SchoolLevel::all();
        return view ('admin::schools.edit', compact('school','districts','schoolLevels'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $school = School::findOrFail($id);

        $school->name               = $request->name;
        $school->school_level_id     = $request->input('select-school-level');
        $school->district_id        = $request->input('select-district');
        $school->quantity_student   = $request->quantity;
        $school->save();

        Session::flash('message', 'Successfully updated provincial!');
        return redirect('admin/school/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $districts    =  District::all();
        $schoolLevels =  SchoolLevel::all();
        return view('admin::schools.create',compact('districts','schoolLevels'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $school = new School();

        $school->name               = $request->name;
        $school->school_level_id     = $request->input('select-school-level');
        $school->district_id        = $request->input('select-district');
        $school->quantity_student   = $request->quantity;
        $school->save();

        Session::flash('message', 'Successfully created provicial!');
        return redirect('admin/school/index');
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
    }

}
