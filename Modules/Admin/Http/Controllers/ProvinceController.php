<?php

namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\Province;
use App\Repositories\Province\ProvincialEloquentRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class ProvinceController extends Controller
{
    protected $repository;
    public function __construct(ProvincialEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::province.pagination',
            [
                'provincials' => $this->repository->getObjects($per_page, $search),
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
        $provincials =  $this->repository->getObjects($records);
        $pages = $this->repository->getPages($records);
        return view('admin::province.index', compact('provincials','pages'));
    }

    /**
     * show a provincial
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $provincial = Province::findOrFail ($id);
        return view('admin::province.show',compact('provincial'));
    }

    /**
     * edit a provincial
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $provincial =  Province::findOrFail($id);
        $areas =  Area::all();
        return view ('admin::province.edit', compact('provincial','areas'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $provincial = Province::findOrFail($id);

        $provincial->name        = $request->name;
        $provincial->area_id        = $request->input('select-provincial');
        $provincial->save();
        Session::flash('message', 'Successfully updated provincial!');
        return redirect('admin/province/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $areas= Area::all();
        return view('admin::province.create',compact('areas'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $provincial = new Province();
        $provincial->name        = $request->name;
        $provincial->area_id = $request->input('select-area');
        $provincial->save();

        Session::flash('message', 'Successfully created provicial!');
        return redirect('admin/province/index');
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
