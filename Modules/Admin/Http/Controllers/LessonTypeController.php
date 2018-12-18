<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\TypeLesson\TypeLessonEloquentRepository;
use Illuminate\Support\Facades\Session;
use App\Models\LessonType;

class LessonTypeController extends Controller
{
    protected $repository;
    public function __construct(TypeLessonEloquentRepository $repository){
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function pagination(Request $request,$records,$search=null){
         $per_page   = is_null($records) ? 10 : $records;
         return view('admin::typeLesson.pagination',[
            'types' => $this->repository->getObjects($per_page,$search),
            'pages' => $this->repository->getPages($per_page,$search),
            'records'     => $per_page,
            'currentPage' => $request->page
         ]);
    }
    public function index()
    {   
        $records=10;
        return view('admin::typeLesson.index',[
            'types' => $this->repository->getObjects($records),
            'pages' => $this->repository->getPages($records),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::typeLesson.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $id=null;
         $this->validation($request,$id);
        try {
            $index=LessonType::max('id_qualify');
            $array = $request->all();
            if($request->id == null){
                $array['id_qualify']=$index+1;
            }
            $this->repository->create($array);
            message($request, 'success', 'Thêm mới thành công.');

        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.typeLesson.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $type=$this->repository->find($id);
        return view('admin::typeLesson.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
         $this->validation($request,$id);
         try {
            
            $array = $request->all();
            $this->repository->update($request->id,$array);
            message($request, 'success', 'Cập nhật thành công.');

        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.typeLesson.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
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

    public function validation($request,$id=null){
        $message=[
            'unique'=>'Trường này đã tồn tại.', 
            'required'=> 'Trường này không được để trống.',
        ];
        $validatedData = $request->validate([
        'name' => 'required',
        'id_qualify'=>'unique:lesson_types,id_qualify,'.$id,
        ],$message);
    }
}
