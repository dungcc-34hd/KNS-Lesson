<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\Provincial;
use App\Repositories\Provincial\ProvincialEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class ProvincialController extends Controller
{
    protected $repository;
    public function __construct(ProvincialEloquentRepository $repository)
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
        $provincials =  Provincial::all();
        $pages = $this->repository->getPages($records);
        return view('admin::provincials.index', compact('provincials','pages'));
    }

    /**
     * show a provincial
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $provincial = Provincial::findOrFail ($id);
        return view('admin::provincials.show',compact('provincial'));
    }

    /**
     * edit a provincial
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $provincial =  Provincial::findOrFail($id);
        $areas =  Area::all();
        return view ('admin::provincials.edit', compact('provincial','areas'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $provincial = Provincial::findOrFail($id);

        $provincial->name        = $request->name;
        $provincial->area_id        = $request->input('select-provincial');
        $provincial->save();
        Session::flash('message', 'Successfully updated provincial!');
        return redirect('admin/provincial/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $areas= Area::all();
        return view('admin::provincials.create',compact('areas'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $provincial = new Provincial();
        $provincial->name        = $request->name;
        $provincial->area_id = $request->input('select-area');
        $provincial->save();

        Session::flash('message', 'Successfully created provicial!');
        return redirect('admin/provincial/index');
    }

    public function delete($id)
    {
        $provincial = Provincial::findOrFail($id);
        $provincial->delete();
    }

}
