<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class DateController extends Controller
{
    /**
     * Date
     */
    public function index(){
        $data = array(
            'page_title' => 'Important Dates | ICDS 2023',
        );
        return view('front.date')->with($data);
    }
}
