<?php


namespace Modules\admin\Http\Controllers;

use App\Models\PermissionRole;
use App\Permission;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    public function view($id)
    {
//        canPermissions(Permissions::Role());
        self::nullProperty($id);
        $arrays = self::hasPermissions((int)$id);
        $permissionType = Permission::getPermissionsByType();

        return view('admin::role.view',
            [
                'role'             => Role::find($id),
                'permissions'      => $arrays,
                'permissionByType' => $permissionType,
                'view'             => true
            ]);

    }

    /*
         * Author: minhpt
         * Create: 08/09/2017
         * Description: edit role
         */
    public function create(Request $request)
    {
//        canPermissions(Permissions::Role());
        try {
            if ($request->isMethod('get')) {
                $arrays = self::hasPermissions();
                $permissionType = Permission::getPermissionsByType();

                return view('admin::role.create',
                    [
                        'permissions'      => $arrays,
                        'permissionByType' => $permissionType,
                        'create'           => true
                    ]);
            }
            $name = $request->input('name');
            $display_name = $request->input('display_name');
            $description = $request->input('description');
            $permissions = $request->permission;

            $role_id = Role::createRole($name, $display_name, $description);

            if (isset($permissions)) {
                foreach ($permissions as $key => $permission) {
                    PermissionRole::addPermissionRole($key, $role_id);
                }
            }
            $request->session()->flash('flash_level', 'success');
            $request->session()->flash('flash_message', 'Complete update infomation for role has id is ' . $role_id);

        } catch (QueryException $exception) {
            Log::error('RoleController->edit: ' . $exception);

            $request->session()->flash('flash_level', 'danger');
            $request->session()->flash('flash_message', 'The system is faulty to contact administrator');
        }

        return redirect('role/view/' . $role_id);
    }

    /*
     * Author: minhpt
     * Create: 08/09/2017
     * Description: edit role
     */
    public function edit(Request $request, $id = null)
    {
//        canPermissions(Permissions::Role());
        self::nullProperty($id);
        try {
            self::notActionGlobalAdmin($id);
            if ($request->isMethod('get')) {
                $arrays = self::hasPermissions($id);
                $permissionType = Permission::getPermissionsByType();

                return view('admin::role.edit',
                    [
                        'role'             => Role::find($id),
                        'permissions'      => $arrays,
                        'permissionByType' => $permissionType,
                        'edit'             => true
                    ]);
            }
            $role_id = $request->input('id');
            $name = $request->input('name');
            $display_name = $request->input('display_name');
            $description = $request->input('description');
            $permissions = $request->permission;

            Role::updateRole($role_id, $name, $display_name, $description);
            PermissionRole::deleteAll($role_id);
            if (isset($permissions)) {
                foreach ($permissions as $key => $permission) {
                    PermissionRole::addPermissionRole($key, $role_id);
                }
            }
            $request->session()->flash('flash_level', 'success');
            $request->session()->flash('flash_message', 'Complete update infomation for role has id is ' . $role_id);

        } catch (QueryException $exception) {
            Log::error('RoleController->edit: ' . $exception);
            $request->session()->flash('flash_level', 'danger');
            $request->session()->flash('flash_message', 'The system is faulty to contact administrator');

        }

        return redirect()->route('admin.role.index');
    }

    /*
     * author: minhpt
     * create: 08/09/2017
     * description: delete role
     */

    public function delete($id)
    {
//        canPermissions(Permissions::Role());
        try {
            self::processDelete($id);

            return response()->json(['status' => true]);
        } catch (\QueryException $exception) {
            Log::error('RoleController->delete: ' . $exception);

            return response()->json(['status' => false]);
        }
    }

    public function deleteViewDetail(Request $request, $id)
    {
//        canPermissions(Permissions::Role());
        self::nullProperty($id);
        try {
            self::processDelete($id);
            $request->session()->flash('flash_level', 'success');
            $request->session()->flash('flash_message', 'Complete deleted');
        } catch (\QueryException $exception) {
            Log::error('RoleController->deleteViewDetail: ' . $exception);
            $request->session()->flash('flash_level', 'danger');
            $request->session()->flash('flash_message', 'The system is faulty to contact administrator');
        }

        return \redirect()->route('admin.role.index');
    }

    /*
     * author: minhpt
     * create: 08/09/2017
     * description: get all permissions and role has permissions
     */
    public function hasPermissions($id = null)
    {
        $permissionArrays = Permission::getPermissions();
        if ($id != null)
            $roleArrays = Role::getPermissionRole($id);
        $arrays = [];
        if (count($permissionArrays) > 0) {
            foreach ($permissionArrays as $permissionArray) {
                $array = [
                    'name' => $permissionArray['display_name'],
                    'has'  => 0,
                    'id'   => $permissionArray['id'],
                    'type' => $permissionArray['type']
                ];
                if ($id != null) {
                    if (count($roleArrays) > 0) {
                        $ok = false;
                        foreach ($roleArrays as $roleArray) {
                            if ($roleArray->permissions_id == $permissionArray['id']) {
                                $ok = true;
                                break;
                            }
                        }
                        if ($ok) {
                            $array = [
                                'name' => $permissionArray['display_name'],
                                'has'  => 1,
                                'id'   => $permissionArray['id'],
                                'type' => $permissionArray['type']
                            ];
                        }

                    }
                }
                array_push($arrays, $array);
            }
        }

        return $arrays;
    }

    public function notActionGlobalAdmin($id)
    {
        if ($id == 1) {
            return abort(404);
        }
    }

    public function processDelete($id)
    {
        self::notActionGlobalAdmin($id);
//        PermissionRole::deleteAll($id);
//        RoleUser::deleteByRoleId($id);
        Role::deleteRole($id);
    }

    public function nullProperty($id)
    {
        if (is_null(Role::find($id)))
            return abort(404);
    }
}