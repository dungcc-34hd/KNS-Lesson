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
      
        try {
             $array = $request->all();
            if ($request->id_type==null) {
                $index=LessonType::max('id_type');  
                    $array['id_type']=$index+1;      
            }else{
                $array['id_type']=$request->id_type;
            }
            // dd($array['id_type']);
            
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
       
         try {
            
            $array = $request->all();
             if ($request->id_type==null) {
                $index=LessonType::max('id_type');  
                    $array['id_type']=$index+1;      
            }else{
                $array['id_type']=$request->id_type;
            }
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

    public function checkName(Request $rq){
        if($rq->id <=0){
            $name= LessonType::where('name',$rq->name)->exists();
        }else{
            $name = LessonType::where('name',$rq->name)->whereNotIn('id',[$rq->id])->exists();
        }
        return response()->json(!$name);
    }
    
     public function checkId(Request $rq){
        if($rq->id <=0){
            $id_type= LessonType::where('id_type',$rq->id_type)->exists();
        }else{
            $id_type = LessonType::where('id_type',$rq->id_type)->whereNotIn('id',[$rq->id])->exists();
        }
        return response()->json(!$id_type);
    }
}
