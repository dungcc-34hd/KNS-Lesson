<?php


namespace Modules\admin\Http\Controllers;


use App\Repositories\User\UserEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserEloquentRepository $repository)
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

        return view('admin::user.pagination',
            [
                'users' => $this->repository->getObjects($per_page, $search),
                'pages'       => $this->repository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page
            ]);
    }

    /**
     * Index of user
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function index()
    {
        $records = 10;
        return view('admin::user.index',
            [
                'users' => $this->repository->getObjects($records),
                'pages'       => $this->repository->getPages($records),
            ]);
    }

    /**
     * Edit of user
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        $roles = $this->repository->getRoles();
        $rolesOfUser = $this->repository->getRoleByUserID($id);
        return view('admin::user.edit', compact('user', 'roles', 'rolesOfUser'));
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
            $array['password'] = Hash::make('123456');
            $this->repository->update($request->id, $array);
            $this->repository->assignRoleForUser($array['id'], $array['roles']);
            message($request, 'success', 'Updated Complete');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.user.index');

    }   


    /**
     * Create of user
     * @author minhpt
     * @date 18/04/2018
     * @param  null
     * @return view
     */
    public function create()
    {
        $roles = $this->repository->getRoles();
        return view('admin::user.create', compact('roles'));
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
            $array['password'] = Hash::make('123456');
            $id = $this->repository->create($array)->id;
            $this->repository->assignRoleForUser($id, $array['roles']);
            message($request, 'success', 'Created Complete');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.user.index');

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
            return response()->json(['status' => true]);
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            return response()->json(['status' => false]);
        }

    }

    /**
     * Show the specified resource.
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request
     * @return view
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        return view('admin::user.detail', compact('user'));
    }

    /**
     * Get roles by user id
     * @author minhpt
     * @date 18/04/2018
     * @param  Request $request
     * @return view
     */
    public function getRolesByUserID($id)
    {
        $roles = $this->repository->getRoleByUserID($id);
        $array = [];
        foreach ($roles as $role)
        {
            array_push($array, $role->id);
        }
        return response()->json($array);
    }
}