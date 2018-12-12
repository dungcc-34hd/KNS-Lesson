<?php


namespace Modules\admin\Http\Controllers;

use App\Models\PermissionRole;
use App\Permission;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /*
     * @params roleRepositoryInterface
     */
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->roleRepository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::role.pagination',
            [
                'roles'       => $this->roleRepository->getObjects($per_page, $search),
                'pages'       => $this->roleRepository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }

    public function index()
    {
//        canPermissions(Permissions::Role());
        $records = 10;
        return view('admin::role.index',
            [
                'roles'       => $this->roleRepository->getObjects($records),
                'pages'       => $this->roleRepository->getPages($records),
            ]);
    }

    /*
     * Author: minhpt
     * Create: 08/09/2017
     * Description: edit role
     */

    
    /*
         * Author: minhpt
         * Create: 08/09/2017
         * Description: edit role
         */
    public function create()
    {
        $permissions=$this->roleRepository->getPermission();
        return view('admin::role.create',compact('permissions'));
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
        try
        {
            $array = $request->all();
            $name=$request->name;
            $display_name=$request->display_name;
            $description=$request->description;
            $permission_id=$request->permission_id;

            $role_id=Role::create(['name'=>$name,'display_name'=>$display_name,'description'=>$description])->id;
            
             PermissionRole::create(['permission_id'=>$permission_id,'role_id'=>$role_id]);

            message($request, 'success', 'Tạo mới thành công.');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.role.index');

    }
     public function edit($id)
    {
         $role=$this->roleRepository->getRole($id)->first();
         $permissions=$this->roleRepository->getPermission();
        return view('admin::role.edit', compact('permissions','role'));
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
        try {
            
            $array = $request->all();
            $name=$request->name;
            $display_name=$request->display_name;
            $description=$request->description;
          
            $permission_id=$request->permission_id;
      
            $role_id=Role::where('id', $request->id)->update(['name'=>$name,'display_name'=>$display_name,'description'=>$description]);
            
             PermissionRole::where('role_id',$request->id)->update(['permission_id'=>$permission_id]);

           
            message($request, 'success', 'Cập nhật thành công.');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.role.index');

    }
  

    public function delete($id)
    {
        try
        {
            Role::where('id', '=', $id)->delete();
            PermissionRole::where('role_id','=',$id)->delete();
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
   

