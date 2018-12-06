<?php

namespace Modules\admin\Http\Controllers;


use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonAnswer;
use App\Models\LessonContent;
use App\Models\LessonDetail;
use App\Models\School;
use App\Repositories\ManagerLesson\ManagerLessonEloquentRepository;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;

class ManagerLessonController extends Controller
{
    protected $repository;

    public function __construct(ManagerLessonEloquentRepository $repository)
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
        return view('admin::managerLesson.index', compact('lessons', 'pages', 'lessonDetails', 'grades'));
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin::managerLesson.show', compact('school'));
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin::managerLesson.edit', compact('school', 'districts', 'schoolLevels'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        return redirect('admin/managerLesson/index');
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

        return view('admin::managerLesson.create', compact('lessonDetails', 'lessons', 'grades', 'lessonDetails'));
    }

    /**
     * show Popup add khối (tạo folder + db)
     */
    public function storeLesson(Request $request)
    {
        $lesson = new Lesson();
        $lesson->name = $request->name;
        $lesson->grade_id = $request->grade;

        //make directory
        $directory = public_path() . "/modules/managerContent/" . $lesson->name;
        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }
//        if (!File::exists($directory)) {
//            $backgroundAudio = public_path() . "/modules/managerContent/" . $request->backgroundAudio;
//            $backgroundImage = public_path() . "/modules/managerContent/" . $request->backgroundImage;
//            File::makeDirectory($directory);
//        }
//
//        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
//        $backgroundImage = $request['background-image'][0]->getClientOriginalName();
//        $request->file('background-audio')[0]->move($directory, $backgroundAudio);
//        $request->file('background-image')[0]->move($directory, $backgroundImage);
//        $lesson->background_audio = $backgroundAudio;
//        $lesson->background_image = $backgroundImage;
        $lesson->save();
        return redirect('admin/manager-lesson/create');
    }

    /**
     * @param Request $request
     *  add tiêu đề theo khối (create folder + lưu db)
     */
    public function storeLessonDetail(Request $request)
    {
        $detailLesson = new LessonDetail();
        $detailLesson->title = $request['detail-lesson'];
        $detailLesson->lesson_id = $request['lesson-id'];
        $detailLesson->type = $request['type'];
        $detailLesson->outline = $request['outline'];

        //make directory
        $directory = public_path() . "/modules/managerContent/" . $request['lesson-name'] . '/' . $detailLesson->title;
        if (!File::exists(public_path() . $directory)) {
            File::makeDirectory($directory);
        }

//        $backgroundAudio = $request['background-audio'][0]->getClientOriginalName();
//        $backgroundImage = $request['background-image'][0]->getClientOriginalName();
//        $request->file('background-audio')[0]->move($directory, $backgroundAudio);
//        $request->file('background-image')[0]->move($directory, $backgroundImage);
//        $detailLesson->background_audio = $backgroundAudio;
//        $detailLesson->background_image = $backgroundImage;
        $detailLesson->save();
        return redirect('admin/manager-lesson/create');
    }

    /**
     * @param $id , type , title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getValueType($id)
    {
        $typeId = $this->repository->getTypeById($id);
        $lessonDetail = $this->repository->getTitleById($id);
        $lesson = $this->repository->getLessonNameById($id);
        return view('admin::managerLesson.addLessonContent', compact('typeId', 'id', 'lesson','lessonDetail'));
    }

    /**
     * get request store
     * lesson content , lesson answer
     * @param Request $request
     */
    public function storeLessonContent(Request $request)
    {
        $contentLesson = new LessonContent();
        $contentLesson->title = $request['title'];
        $contentLesson->content = $request['content'];
        $contentLesson->lesson_detail_id = $request['lesson-detail-id'];
        $contentLesson->question = $request['question'];

        //make directory
        $directory = public_path() . "/modules/managerContent/" .$request['lesson'].'/'. $request['lesson-detail'] ;
        $contentLesson->path = $directory;
        $names = [];
        foreach ( $request['background-image'] as $item)
        {
            $filename = $item->getClientOriginalName();
            $item->move($directory, $filename);
            $contentLesson->path = $directory .'/'.$filename;
            array_push($names, $filename);
        }
        $contentLesson->audio = json_encode($names);
        $contentLesson->save();
        if($request['type'] == 3)
        {

            $is_correct = isset($request['is-correct']) ?  $request['is-correct'][0] : null;
            foreach ($request['answer'] as $key => $item)
            {
                $lessonAnswer = new LessonAnswer();
                $lessonAnswer->lesson_content_id = $contentLesson->id;
                $lessonAnswer->answer = $item;
                $lessonAnswer->is_correct =false;
                if($key == $is_correct)
                {
                    $lessonAnswer->is_correct = true;
                }
                $lessonAnswer->save();
            }
        }
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
    }
}
