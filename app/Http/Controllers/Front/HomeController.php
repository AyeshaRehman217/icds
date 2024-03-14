<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Home
     */
    public function index(){
        $data = array(
            'page_title' => 'ICDS 2023',
        );
        return view('front.index')->with($data);
    }
}
