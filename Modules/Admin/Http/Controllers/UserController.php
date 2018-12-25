<?php


namespace Modules\admin\Http\Controllers;

use App\Models\Area;
use App\Models\LsClass;
use App\Models\District;
use App\Models\School;
use App\Models\Province;
use App\Models\UserThematic;
use App\User;
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
        $per_page   = is_null($records) ? 10 : $records;
        $areas      = Area::all();
        return view('admin::user.pagination',
            [
                'users'       => $this->repository->getObjects($per_page, $search),
                'pages'       => $this->repository->getPages($per_page, $search),
                'records'     => $per_page,
                'currentPage' => $request->page,
                'areas'       => $areas
            ]);
    }
    public function pagination_Select(Request $request, $records, $table,$id)
    {
        $per_page            = is_null($records) ? 10 : $records;
        $areaId              = Area::all();
        $users               = $this->repository->getAreaObjects($records,$id,"users.$table");
       
        $pages               = $this->repository->getAreaPages($records,$id,"users.$table"); 
        $count               = $this->repository->getCount($id,"users.$table");
        // dd($request->page);
        return view('admin::user.pagination',
            [
                'users'         => $users,
                'pages'         => $pages,
                'count'         => $count,
                'records'       => $per_page,
                'currentPage'   => $request->page
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
        $records    = 10;
        $areas      = Area::all();
        return view('admin::user.index',
            [
                'users'         => $this->repository->getObjects($records),
                'pages'         => $this->repository->getPages($records),
                'areas'         => $areas

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
        $gradeId=$users->grade_id;
        return view('admin::user.edit',[
            'user'=>$users,
            'areas' => Area::all(),
            'provinces'=>Province::where('area_id','=',$users->area_id)->get(),
            'districts'=>District::where('province_id','=',$users->province_id)->get(),
            'schools'=> School::where('district_id','=',$users->district_id)->get(),
            'grades' => $this->repository->grade(),
            'class' =>  $this->repository->getClass($gradeId),
            'roles' =>$this->repository->getRoles(),
            'thematics'=>$this->repository->getThematic(),
            'findThematics'=>$this->repository->findThematic($id),

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
            $array['password'] = Hash::make($request->password);
            $this->repository->update($request->id, $array);
            $this->repository->addUserThematic($request->id,$array['thematics']);
            message($request, 'success', 'Cập nhật thành công.');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.user.index');

    }  
    
    public function updatePassword(Request $request){
        try {
            $array = $request->all();
            $array['password'] = Hash::make($array['password'] );
            $this->repository->update($request->id, $array);
            message($request, 'success', 'Đổi mật khẩu thành công .');
        }
        catch (QueryException $exception)
        {
            Log::error($exception->getMessage());
            message($request, 'danger', ERROR_SYSTEM);
        }
        return redirect()->route('admin.user.show',['id'=>$request->id]); 
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
        $areaId=0;
        $array=$this->repository->select($areaId);
        $grades=$this->repository->grade();
        $gradeId=0;

        return view('admin::user.create',[
            'areas' => $areas,
            'provinces'=> $array['provinces'],
            'districts'=> $array['districts'],
            'schools'=> $array['schools'],
            'grades' => $grades,
            'class' =>  $this->repository->getClass($gradeId),
            'roles' =>$this->repository->getRoles(),
            'thematics'=>$this->repository->getThematic(),
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
            $array['password'] = Hash::make($request->password);
            $id=$this->repository->create($array)->id;
            $this->repository->addUserThematic($id,$array['thematics']);
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
            $this->respository->DeleleUserThematic($id);
           Session::flash('flash_level', 'success');
          Session::flash('flash_message', 'Xoá thành công');
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

       $array=$this->repository->show($id);
       $user=$array['user'];
       $thematics=$array['thematic'];
       // dd($user,$thematic);
       return view('admin::user.detail', compact('user','thematics'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Session::flash('flash_level', 'success');
        Session::flash('flash_message', 'Xoá thành công');
        
    }

     /**
     * hanlding ajax for Area reutrn provinces
 
     */
    public function hanldingArea(Request $req)
    {
        $title          = "Chọn Tỉnh";
        $records        = 10;
        $area_id        = $req->area;
        $Users          = $this->repository->getAreaObjects($records,$area_id,'area_id');
        $page           = $this->repository->getAreaPages($records,$area_id,'area_id');
        $count          = $this->repository->getCount($area_id,'area_id');
        $provinces      = Province::where('area_id',$area_id)->get();
        

        $select         = $this->returnOption($provinces,$title );

        $user           = $this->returnTr($Users);
        
        return response()->json(['select' => $select,'user'=>$user,'count'=>$count]);  
    }

     /**
     * hanlding ajax for Province reutrn district
     */
    public function hanldingProvince(Request $req)
    {
        $title          = "Chọn Quận/Huyện";
        $records        =10;
        $province_id    = $req->province;
        $Users          = $this->repository->getAreaObjects($records,$province_id ,'users.province_id');
        $page           = $this->repository->getAreaPages($records,$province_id ,'users.province_id');
        $districts      = District::where('province_id',$province_id )->get();
        
        $select         = $this->returnOption($districts,$title );
        $user           = $this->returnTr($Users);

        return response()->json(['select' => $select,'user'=>$user]);  
    }

      /**
     * hanlding ajax for Province reutrn district
     */
    public function select(){
        $records            =10;
        $data               = $this->repository->getObjects($records);
        $user              = $this->returnTr($data);
        return response()->json(['user'=>$user]); 
    }
    public function hanldingDistrict(Request $req)
    {
        $title          = "Chọn Trường";
        $records        = 10;
        $district_id    = $req->district;
        $Users          = $this->repository->getAreaObjects($records,$district_id ,'users.district_id');
        $page           = $this->repository->getAreaPages($records,$district_id ,'users.district_id');
        $school         = School::where('district_id',$district_id)->get();
        
        $select         = $this->returnOption($school,$title );
        $user           = $this->returnTr($Users);

        return response()->json(['select' => $select,'user'=>$user]);    
    }
    
    public function hanldingSchool(Request $req)
    {

        $records        = 10;
        $school_id      = $req->school;
        $Users          = $this->repository->getAreaObjects($records,$school_id ,'school_id');
        $page           = $this->repository->getAreaPages($records,$school_id ,'school_id');

        $user           = $this->returnTr($Users);

        return response()->json(['user' => $user]);  
    }



    // return json
    public function returnOption($provinces,$title){
        $arrayOption = array("<option value='' >$title</option>");
        foreach ($provinces as  $value) {
            $option = "<option value='".$value->id."'>".$value->name."</option>";
            array_push($arrayOption, $option);
        }
        $select = implode(" ",$arrayOption);

        return $select;
    }
    public function returnTr($Users){
        
        $arrayUser      =  array();
        if($Users!=null){
            foreach ($Users as $key =>  $user) {
                $key = $key+1;
                $option = " 
                <tr>
                <td >".$key."</td>
                <td>".$user->name."</td>
                <td>".$user->email."</td>
                <td>".$user->school['name']."</td>
                <td>".$user->grade['name']."</td>
                <td>".$user->lsClass['name']."</td>
                <td>".$user->quantity_student."</td>
                <td>".$user->role['name']."</td>
                <td> ".$user->IP."</td>
                <td>".$user->download."</td>
                <td> <div class='btn-group btn-group-sm'>
                <a class='btn btn-success' href='/admin/user/show/".$user->id."' title='Detail'>
                <i class='fa fa-eye'></i>
                </a>
                <a class='btn btn-info' href='/admin/user/edit/".$user->id."' title='Edit'>
                <i class='ace-icon fa fa-pencil'></i>
                </a>
                <a href='' class='btn btn-danger delete-object' title='Delete' object_id='".$user->id."' object_name='".$user->name."'>
                <i class='fa fa-trash-o'></i>
                </a>
                </div></td>
                </tr>";
                array_push($arrayUser, $option);
            }
       
        }
        else{
            $option = "<tr> <td colspan='11'>Không có bản ghi nào</td> </tr>";
            array_push($arrayUser, $option);
        }
        $user  = implode(" ",$arrayUser);

        return $user;
 
    }

    public function checkEmail(Request $rq ,$id){
        if($id<=0){
            $email = User::where('email',$rq->email)->exists();
            return response()->json(!$email);
        }else{
            $email = User::where('email',$rq->email)->whereNotIn('id',[$rq->id])->exists();
             return response()->json(!$email);
        } 
    }
 
}