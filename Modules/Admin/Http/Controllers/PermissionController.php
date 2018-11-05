<?php


namespace Modules\admin\Http\Controllers;


use App\Permission;
use App\Repositories\Permission\PermissionEloquentRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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
        $permission = $this->repository->find($id);
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
        try {
            $array = $request->all();
            array_shift($array);
            $this->repository->update($request->id, $array);
            message($request, 'success', 'Updated Complete');
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
        try
        {
            $array = $request->all();
            array_shift($array);
            $this->repository->create($array);
            message($request, 'success', 'Created Complete');
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
        $permission = $this->repository->find($id);
        return view('admin::permission.detail', compact('permission'));
    }
}