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
        $users=$this->repository->find($id);
        $areaId=$users->area_id;
        $gradeId=$users->grade_id;
        $areas=$this->repository->Area();
        $array=$this->repository->select($areaId);
        return view('admin::user.edit',[
            'user'=>$users,
            'areas' => $areas,
            'provinces'=> $array['provinces'],
            'districts'=> $array['districts'],
            'schools'=> $array['schools'],
            'grades' => $this->repository->grade(),
            'class' =>  $this->repository->getClass($gradeId),
            'roles' =>$this->repository->getRoles(),
        ]);
        
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
            message($request, 'success', 'Cập nhật thành công.');
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
        $areas=$this->repository->Area();
        count($areas) >0 ? $areaId=$areas[0]->id : $areaId=0;
        $array=$this->repository->select($areaId);
        $grades=$this->repository->grade();
        count($grades) >0 ? $gradeId=$grades[0]->id : $gradeId=0;

        return view('admin::user.create',[
            'areas' => $areas,
            'provinces'=> $array['provinces'],
            'districts'=> $array['districts'],
            'schools'=> $array['schools'],
            'grades' => $grades,
            'class' =>  $this->repository->getClass($gradeId),
            'roles' =>$this->repository->getRoles(),
        ]);
    }
    public function changeSelect($areaId){
        $array = $this->repository->select($areaId);
         return response()->json($array);
    }
    public function changeProvince($provinceId){
        $array = $this->repository->district($provinceId);
        return response()->json($array);
    }
    public function changeDistrict($districtId){
        $array = $this->repository->school($districtId);
        return response()->json($array);
    }
    public function changeGrade($gradeId){
        $array = $this->repository->getClass($gradeId);
        return response()->json($array);
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
            $this->repository->create($array);
            message($request, 'success', 'Thêm mới thành công.');
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
       $user = $this->repository->show($id);
        return view('admin::user.detail', compact('user'));
    }

}