<?php

namespace App\Repositories\ManagerLesson;

use App\Models\Lesson;
use App\Models\LessonDetail;
use App\Models\School;
use App\Repositories\EloquentRepository;

class ManagerLessonEloquentRepository extends EloquentRepository implements ManagerLessonEloquentInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Lesson::class;
    }

    /**
     * Get pages
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getPages($records, $search = null)
    {
        $total = !is_null($search) ? count($this->_model->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
//            $q->orWhere('description', 'like', '%' . $search . '%');
        })->get()) : count($this->_model->get());
        return ceil($total / $records);
    }

    /**
     * Get all
     * @author Minhpt
     * @date 17/04/2018
     * @return mixed
     */
    public function getObjects($records, $search = null)
    {
            return is_null($search) ? $this->_model->paginate($records)->items() : $this->_model->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
//              $q->orWhere('description', 'like', '%' . $search . '%');
            })->paginate($records)->items();

    }

    public function getImage($image)
    {
        $images = null;
        foreach ($images as $image)
        {
            $image->getClientOriginalName();
        }
        return $image;
    }

    public function getTypeById($id)
    {
        return LessonDetail::where('id',$id)->first()->type;
    } 

    public function getTitleById($id)
    {
        return LessonDetail::where('id',$id)->first()->title;
    }
    public function getLessonIdById($id)
    {
        return LessonDetail::where('id',$id)->first()->lesson_id;
    }
    public function getLessonNameById($lesson_id)
    {
        return Lesson::where('id',$this->getLessonIdById($lesson_id))->first()->name;
    }

    public function getNameLessonById($id)
    {
        return Lesson::where('id',$id)->first()->name;
    }

    public function getLessonNameByGradeId($gradeId)
    {
        return Lesson::where('grade_id',$gradeId)->get();
    }
}