<?php


namespace Modules\admin\Http\Controllers;


use App\Permission;
use App\Repositories\Permission\PermissionEloquentRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Role;
use Illuminate\Support\Facades\Session;
use App\Models\PermissionRole;

class PermissionController extends Controller
{

    public $repository;

    public function __construct(PermissionEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Result will append in table.
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request, $records, $search
     * @return view
     */
    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::permission.pagination',
            [
                'permissions' => $this->repository->getObjects($per_page, $search),
                'pages'       => $this->repository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }

    /**
     * Index of Permission
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function index()
    {
        $records = 10;
        return view('admin::permission.index',
            [
                'permissions' => $this->repository->getObjects($records),
                'pages'       => $this->repository->getPages($records),
            ]);
    }

    /**
     * Edit of Permission
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function edit($id)
    {
         
         $permission=$this->repository->find($id);
        return view('admin::permission.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request
     * @return view
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
        return redirect()->route('admin.permission.index');

    }


    /**
     * Create of Permission
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function create()
    {
        return view('admin::permission.create');
    }

    /**
     * Store a newly created resource in storage.
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request
     * @return view
     */
    public function store(Request $request)
    {
        $this->validation($request,$id=null);
        try
        {
            $array = $request->all();
            $this->repository->create($array);
            message($request, 'success', 'Tạo mới thành công.');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request
     * @return view
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
        'name' => 'required|unique:permissions,name,'.$id,
        'display_name'=>'required|unique:permissions,display_name,'.$id,
        ],$message);
    }
}