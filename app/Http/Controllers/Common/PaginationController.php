<?php

namespace App\Http\Controllers\Common;


use Illuminate\Routing\Controller;

class PaginationController extends Controller
{
    public function index($current_page, $total_page)
    {
        return view('pagination.index')
            ->with('current_page',(int)$current_page)
            ->with('total_page',(int)$total_page);
    }
}