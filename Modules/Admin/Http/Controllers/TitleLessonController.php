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
    public function storeLesson(Request $request)
    {
        $lesson = new Lesson();
        $lesson->name = $request->name;
        $lesson->grade_id = $request->grade;
        $directory = public_path() . "/modules/managerContent/" . $lesson->name;

        if (!File::exists($directory)) {
            $backgroundAudio = public_path() . "/modules/managerContent/" . $request->backgroundAudio;
            $backgroundImage = public_path() . "/modules/managerContent/" . $request->backgroundImage;
            File::makeDirectory($directory);
        }

        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
        $backgroundImage = $request['background-image'][0]->getClientOriginalName();
        $request->file('background-audio')[0]->move($directory, $backgroundAudio);
        $request->file('background-image')[0]->move($directory, $backgroundImage);
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

        $detailLesson = new LessonDetail();
        $detailLesson->name = $request['detail-lesson'];
        $detailLesson->lesson_id = $request['lesson-id'];
        $directory = public_path() . "/modules/managerContent/" . $request['lesson-name'] . '/' . $detailLesson->name;
        if (!File::exists(public_path() . $directory)) {
            File::makeDirectory($directory);
        }

        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
        $backgroundImage = $request['background-image'][0]->getClientOriginalName();
        $request->file('background-audio')[0]->move($directory, $backgroundAudio);
        $request->file('background-image')[0]->move($directory, $backgroundImage);
        $detailLesson->background_audio = $backgroundAudio;
        $detailLesson->background_image = $backgroundImage;
        $detailLesson->save();
    }

    public function storeLessonContent(Request $request)
    {
        $detailLesson = new LessonDetail();
        $detailLesson->name = $request['detail-lesson'];
        $detailLesson->lesson_id = $request['lesson-id'];
        $directory = public_path() . "/modules/managerContent/" . $request['lesson'] . '/' . $detailLesson->name;
        if (!File::exists(public_path() . $directory)) {
            File::makeDirectory($directory);
        }
        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
        $request->file('background-audio')[0]->move($directory, $backgroundAudio);

        foreach ( $request['background-image'] as $item)
        {
            $backgroundAudio =  basename($item[0]->getClientOriginalName());
            move_uploaded_file($item[0], $directory . '/' . $backgroundAudio);
        }

        $detailLesson->background_audio = $backgroundAudio;
//        $detailLesson->background_image = $backgroundImage;
        $detailLesson->save();
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
    }
}
