<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    /**
     * Speaker
     */
    public function index(){
        $data = array(
            'page_title' => 'Speakers | ICDS 2023',
        );
        return view('front.speaker')->with($data);
    }
}
