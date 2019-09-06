<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
public function updateOrderLesson($id, $start, $stop)
    {
        if ($start < $stop) {
            $orderLessonDetail = LessonDetail::where('lesson_id', $id)->where('order', '>=', $start)->where('order', '<=', $stop)->orderBy('order')->get();
            foreach ($orderLessonDetail as $key => $item) {
                if ($item->order == $start) {
                    $item->order = $stop;
                } else {
                    $item->order--;
                }
                $item->save();

            }
        } else {
            $orderLessonDetail = LessonDetail::where('lesson_id', $id)->where('order', '>=', $stop)->where('order', '<=', $start)->orderBy('order')->get();
            foreach ($orderLessonDetail as $key => $item) {
                if ($item->order == $start) {
                    $item->order = $stop;
                } else {
                    $item->order++;
                }
                $item->save();

            }
        }
    }
