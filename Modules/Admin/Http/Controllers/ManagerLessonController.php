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
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

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

        return view('admin::managerLesson.pagination',
            [
                'managerLesson' => $this->repository->getObjects($per_page, $search),
                'pages' => $this->repository->getPages($per_page, $search),
                'records' => $per_page,
                'currentPage' => $request->page,
                'lessonName' => $this->repository->getLessonNameByGradeId($search),
                'lessons' => Lesson::all(),
                'lessonDetails' => LessonDetail::all(),
                'lessonContents' => LessonContent::all(),
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lessons = Lesson::all();
        $grades = Grade::all();
        $lessonDetails = LessonDetail::all();
        $lessonContents = LessonContent::all();
        return view('admin::managerLesson.index', compact('lessonDetails', 'lessons', 'grades', 'lessonDetails', 'lessonContents'));
    }

    public function getLessonName($gradeId)
    {
        $lessonName = $this->repository->getLessonNameByGradeId($gradeId);
        return response($lessonName);
    }

    public function addLesson()
    {
        $grades = Grade::all();
        return view('admin::managerLesson.addLesson', compact('grades', 'lesson'));
    }

    public function editLesson($id)
    {
        $lesson = Lesson::findorfail($id);
        $grades = Grade::all();
        return view('admin::managerLesson.addLesson', compact('grades', 'lesson'));
    }

    /**
     * show
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDetailLesson($id)
    {
        $lessonDetail = LessonDetail::findorFail($id);
        return view('admin::managerLesson.showDetailLesson', compact('lessonDetail'));
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
        $lesson->save();
        return redirect('admin/manager-lesson/index');
    }

    /**
     * edit Popup add khối (tạo folder + db)
     */
    public function updateLesson(Request $request, $id)
    {
        $lesson = Lesson::findorFail($id);

        //edit directory
        $newDirectory = public_path() . "/modules/managerContent/" . $request->name;
        $directoryOld = public_path() . "/modules/managerContent/" . $lesson->name;
        rename($directoryOld, $newDirectory);
        $lesson->name = $request->name;
        $lesson->grade_id = $request->grade;
        $lesson->save();
        return redirect('admin/manager-lesson/index');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * add tiêu đề theo khối (create folder + lưu db)
     */
    public function storeLessonDetail(Request $request)
    {
        $detailLesson = new LessonDetail();
        $detailLesson->title = $request['detail-lesson'];
        $detailLesson->lesson_id = $request['lesson-id'];
        $detailLesson->type = $request['type'];
        $detailLesson->outline = $request['outline'];
        $detailLesson->name = $request['name'];

        //make directory
        $directory = public_path() . "/modules/managerContent/" . $request['lesson-detail'] . '/' . $request['detail-lesson'];
        if (!File::exists(public_path() . $directory)) {
            File::makeDirectory($directory);
        }
        $detailLesson->save();
        return redirect('admin/manager-lesson/index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editLessonDetail(Request $request, $id)
    {
        $lessonDetail = LessonDetail::find($id);
        return view('admin::managerLesson.addDetailLesson', compact('lessonDetail'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateLessonDetail(Request $request, $id)
    {
        $detailLesson = LessonDetail::find($id);

        //make directory
        $oldDirectory = public_path() . "/modules/managerContent/" . $this->repository->getNameLessonById($detailLesson->lesson_id) . '/' . $detailLesson->title;
        $newdirectory = public_path() . "/modules/managerContent/" . $this->repository->getNameLessonById($detailLesson->lesson_id) . '/' . $request['detail-lesson'];
        rename($oldDirectory, $newdirectory);
        $detailLesson->title = $request['detail-lesson'];
        $detailLesson->type = $request['type'];
        $detailLesson->outline = $request['outline'];
        $detailLesson->name = $request['name'];
        $detailLesson->save();
        return redirect('admin/manager-lesson/index');
    }

    public function getValueLessonDetail($id)
    {
        $lesson = Lesson::find($id);
        $lessonId = $id;
        $lessonName = $lesson->name;
        return view('admin::managerLesson.addDetailLesson', compact('lessonId', 'lessonName'));
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
        return view('admin::managerLesson.addLessonContent', compact('typeId', 'id', 'lesson', 'lessonDetail'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * lesson content , lesson answer
     */
    public function storeLessonContent(Request $request)
    {
        $contentLesson = new LessonContent();
        $contentLesson->title = $request['title'];
        $contentLesson->lesson_detail_id = $request['lesson-detail-id'];
        $contentLesson->question = $request['question'];

        //make directory
        $directory = public_path() . "/modules/managerContent/" . $request['lesson'] . '/' . $request['lesson-detail'];
        $contentLesson->path = $directory;

        if (!is_null($request->file('background-music'))) {
            if ($request->file('background-music')) {
                $music = $request['background-music']->getClientOriginalName();
                $request['background-music']->move($directory, $music);
                $contentLesson->background_music = $music;
            }
        }

        $names = [];
        if (!is_null($request['background-image'])) {
            foreach ($request['background-image'] as $item) {
                $filename = $item->getClientOriginalName();
                $item->move($directory, $filename);
//                $contentLesson->path = $directory . '/' . $filename;
                array_push($names, $filename);
            }
        }

        $contentLesson->audio = json_encode($names);
        $content = [];
        foreach ($request['content'] as $item) {
            array_push($content, $item);
        }
        $contentLesson->content = json_encode($content, JSON_UNESCAPED_UNICODE);

        $contentLesson->save();

        //nếu là trắc nghiệm
        if ($request['type'] == 3) {

            //$is_correct = isset($request['is-correct']) ? $request['is-correct'][0] : null;
            foreach ($request['answer'] as $key => $item) {
                $lessonAnswer = new LessonAnswer();
                $lessonAnswer->lesson_content_id = $contentLesson->id;
                $lessonAnswer->answer = $item;
                $lessonAnswer->is_correct = false;
                $lessonAnswer->answer_last = false;
                if ($key == 0)
                    $lessonAnswer->is_correct = true;
                if ($request->answer_last == 1)
                    $lessonAnswer->answer_last = 1;
                $lessonAnswer->save();
            }
            $dataDapAn = $this->repository->getQuizDapAn( $contentLesson->id);
            //create json trac nghiem
            $answerDataList = [];
            foreach ($dataDapAn->answer as $key => $item )
            {
                if($key != 0){
                    $answerWrong[] = $item;
                }
            }
            $lessonAnswerData = [
                "answer_last" => ($dataDapAn->answerLast == 1) ? true : false,
                "question" => $dataDapAn->question,
                "answer" => $dataDapAn->answer[0],
                "wrong" => $answerWrong

            ];
            array_push($answerDataList, $lessonAnswerData);
            $jsonData = ["data" => $answerDataList];
            $directory = public_path() . "/modules/managerContent/" .'/'.$request['lesson'].'/'.$request['lesson-detail'];

            File::put($directory . "/tncc.json", json_encode($jsonData,JSON_UNESCAPED_UNICODE));

        }
        return redirect('admin/manager-lesson/index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editLessonContent($id)
    {
        $lessonContent = LessonContent::find($id);
        $typeId = $this->repository->getTypeById($lessonContent->lesson_detail_id);
        $lessonDetail = $this->repository->getTitleById($lessonContent->lesson_detail_id);
        $lesson = $this->repository->getLessonNameById($lessonContent->lesson_detail_id);
        $lessonAnswer = LessonAnswer::findLessonContentByID($id);
        if (is_null($lessonContent)) {
            return view('admin::managerLesson.addLessonContent', compact('typeId', 'id', 'lesson', 'lessonDetail'));
        }
        $contents = json_decode($lessonContent->content);
        $audios = json_decode($lessonContent->audio);

        return view('admin::managerLesson.addLessonContent', compact('typeId', 'id', 'lesson', 'lessonDetail', 'lessonContent', 'contents', 'lessonAnswer', 'audios'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateLessonContent(Request $request, $id)
    {
        $contentLesson = LessonContent::find($id);
        $contentLesson->title = $request['title'];
        $contentLesson->question = $request['question'];

        //make directory
        $directory = public_path() . "/modules/managerContent/" . $request['lesson'] . '/' . $request['lesson-detail'];
        $contentLesson->path = $directory;
//        dd($directoryMusic);
        if (!is_null($request->file('background-music'))) {
            if ($request->file('background-music')) {
                $music = $request['background-music']->getClientOriginalName();
                $request['background-music']->move($directory, $music);
                $contentLesson->background_music = $music;
            }
        }
        $getAudios = json_decode($contentLesson->audio);

        if (!empty($getAudios)) {
            foreach ($getAudios as $getAudio) {
                $directoryImage = public_path() . "/modules/managerContent/" . $request['lesson'] . '/' . $request['lesson-detail'] . '/' . $getAudio;
                File::Delete($directoryImage);

            }
            $names = [];
            if (!is_null($request['background-image'])) {
                foreach ($request['background-image'] as $item) {
                    $filename = $item->getClientOriginalName();
                    $item->move($directory, $filename);

                    array_push($names, $filename);
                }
                $contentLesson->audio = json_encode($names);
            }
        }

        $content = [];
        foreach ($request['content'] as $item) {
            array_push($content, $item);
        }
        $contentLesson->content = json_encode($content, JSON_UNESCAPED_UNICODE);

        $contentLesson->save();

        //nếu là trắc nghiệm
        if ($request['type'] == 3) {
            //$is_correct = isset($request['is-correct']) ? $request['is-correct'][0] : null;
            foreach ($request['answer'] as $key => $item) {
                $lessonAnswer = LessonAnswer::find($id);
                $lessonAnswer->answer = $item;
                $lessonAnswer->is_correct = false;
                $lessonAnswer->answer_last = false;
                if ($key == 0)
                    $lessonAnswer->is_correct = true;
                if ($request->answer_last == 1)
                    $lessonAnswer->answer_last = 1;
                $lessonAnswer->save();
            }
        }
        return redirect('admin/manager-lesson/index');
    }

    /**
     * @param $id
     * delete lesson
     */
    public function deleteLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $directory = public_path() . "/modules/managerContent/" . $lesson->name;
        File::deleteDirectory($directory);
        $lesson->delete();
    }

    /**
     * @param $id
     * delete lesson det5ail
     */
    public function deleteLessonDetail($id)
    {
        $lessonDetail = LessonDetail::findOrFail($id);
        $directory = public_path() . "/modules/managerContent/" . $this->repository->getNameLessonById($lessonDetail->lesson_id) . '/' . $lessonDetail->title;
        File::deleteDirectory($directory);
        $lessonDetail->delete();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * json content
     */
    public function jsonLesson($id)
    {
        $dataContents = $this->repository->getAllContent($id);
        $lessonName = Lesson::find($id);
        $dataDapAns = $this->repository->getQuizDapAn($id);
        $partDataList = [];
        foreach ($dataContents as $dataContent) {
            $lessonData = [
                "type" => LessonDetail::TYPE[$dataContent->lessonDetailType],
                "path" => $dataContent->lessonDetailTitle,
                "title" => $dataContent->lessonDetailName,
                "outline" => $dataContent->lessonDetailOutline,
                "guide" => [
                    "title" => $dataContent->lessonContentTitle,
                    "contents" => json_decode($dataContent->lessonContentContent),
                ]
            ];
            array_push($partDataList, $lessonData);
        }
        $jsonData = ["parts" => $partDataList];
        $directory = public_path() . "/modules/managerContent/" . $lessonName->name;

        File::put($directory . "/config.json", json_encode($jsonData));
    }


    public function publicObject($id){
        try {
            $lesson = $this->repository->find($id);
            $lesson->update(['is_public' => !$lesson->is_public]);
            return response()->json(['status' => true]);
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            return response()->json(['status' => false, 'info' => __('system.error')]);
        }
    }
    public function testObject($id){
        try {
            $lesson = $this->repository->find($id);
            $lesson->update(['is_public' => 1]);
             
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());      

        }
    }

    public function zip($id)
    {
        try{
            $this->jsonLesson($id);
            $nameLesson = Lesson::find($id)->name;

            $zipper = new \Chumper\Zipper\Zipper;
            $files = path.$nameLesson;
            $zipper->make(path.$nameLesson.'.zip')->add($files)->close();
            return redirect()->route('admin.managerLesson.index');
        }catch (\Exception $e) {
            $array = ['error' => 'Không thành công!'];
            return response()->json([
                $array
            ], 502);
        }
    }

}
