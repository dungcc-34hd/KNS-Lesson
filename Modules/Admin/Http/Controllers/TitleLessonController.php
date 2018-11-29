<?php

namespace Modules\admin\Http\Controllers;


use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonDetail;
use App\Models\School;
use App\Repositories\TitleLesson\TitleLessonEloquentRepository;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;

class TitleLessonController extends Controller
{
    protected $repository;

    public function __construct(TitleLessonEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function pagination(Request $request, $records, $search = null)
    {
        $per_page = is_null($records) ? 10 : $records;

        return view('admin::user.pagination',
            [
                'users' => $this->repository->getObjects($per_page, $search),
                'pages' => $this->repository->getPages($per_page, $search),
                'records' => $per_page,
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
        $grades = Grade::all();
        $lessons = Lesson::all();
        $lessonDetails = LessonDetail::all();
        $pages = $this->repository->getPages($records);
        return view('admin::titleLesson.create', compact('lessons', 'pages', 'lessonDetails', 'grades'));
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin::schools.show', compact('school'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin::schools.edit', compact('school', 'districts', 'schoolLevels'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        return redirect('admin/school/index');
    }

    /**
     * creat a provincial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $lessons = Lesson::all();
        $grades = Grade::all();
        $lessonDetails = LessonDetail::all();
        return view('admin::titleLesson.create', compact('lessonDetails', 'lessons', 'grades', 'lessonDetails'));
    }

    /**
     * store a provincial
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        return redirect('admin/title-lesson/index');
    }

    /**
     * show Popup add khối (tạo folder + db)
     */
    public function storeGrade(Request $request)
    {
        $lesson = new Lesson();
        $lesson->name = $request->name;
        $lesson->grade_id = $request->gradeId;
        if (!File::exists(public_path() . "/modules/managerContent/" . $lesson->name)) {
            $directory = public_path() . "/modules/managerContent/" . $lesson->name;
            $backgroundAudio = public_path() . "/modules/managerContent/" . $request->backgroundAudio;
            $backgroundImage = public_path() . "/modules/managerContent/" . $request->backgroundImage;
            File::makeDirectory($directory);
        }
        $destinationPath = public_path() . "/modules/managerContent/" . $lesson->name;
        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
        $backgroundImage = $request['background-image'][0]->getClientOriginalName();
        $request->file('background-audio')[0]->move($destinationPath, $backgroundAudio);
        $request->file('background-image')[0]->move($destinationPath, $backgroundImage);
        $lesson->background_audio = $backgroundAudio;
        $lesson->background_image = $backgroundImage;
        $lesson->save();

    }

    /**
     * @param Request $request
     *  add tiêu đề theo khối (create folder + lưu db)
     */
    public function storeLessonDetail(Request $request)
    {
        if ($request->ajax()) {
            $detailLesson = new LessonDetail();
            $detailLesson->name = $request->detailLesson;
            $detailLesson->save();
            if (!File::exists(public_path() . "/modules/managerContent/" . $request->grade . '/' . $detailLesson->name)) {
                $directory = public_path() . "/modules/managerContent/" . $request->grade . '/' . $detailLesson->name;
                File::makeDirectory($directory);
            }
        }
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
    }
}
