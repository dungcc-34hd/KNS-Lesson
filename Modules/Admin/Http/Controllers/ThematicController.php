<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Thematic;
use App\Repositories\Thematic\ThematicEloquentRepository;
use Illuminate\Support\Facades\Session;

class ThematicController extends Controller
{
    protected $repository;
    public function __construct(ThematicEloquentRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */


    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;


        return view('admin::thematic.pagination',
            [
                'thematics' => $this->repository->getObjects($per_page, $search),
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
        $thematics =  $this->repository->getObjects($records);
        $pages = $this->repository->getPages($records);
        return view('admin::thematic.index', compact('thematics','pages'));
    }

 public function edit($id)
    {
        $thematic =  Thematic::find($id);
        return view ('admin::thematic.edit', compact('thematic'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request ,$id)
    {
        $array = $request->all();
        $this->repository->update($id,$array);   
         message($request, 'success', 'Cập nhật thành công.');
        return redirect('admin/thematic/');
    }

    /**
     * creat a area
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin::thematic.create');
    }

    /**
     * store a area
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $array=$request->all();
        $this->repository->create($array);

         message($request, 'success', 'Thêm mới thành công.');
        return redirect('admin/thematic/');
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

    public function checkName(Request $rq, $id){
        if($id == null){
            $name=Thematic::where('name',$rq->name)->exists();
            return response()->json(!$name);
        }else{
            $name= Thematic::where('name',$rq->name)->whereNotIn('id',[$rq->id])->exists();
            return response()->json(!$name);
        }
    }
}
