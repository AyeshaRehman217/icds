<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    /**
     * AboutUs
     */
    public function index(){
        $data = array(
            'page_title' => 'About Us | ICDS 2023',
        );
        return view('front.about-us')->with($data);
    }
}
