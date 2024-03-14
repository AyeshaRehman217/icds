<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Icds2022Controller extends Controller
{
    /**
     * ICDS 2022 Highlight
     */
    public function index(){
        $data = array(
            'page_title' => 'Highlights | ICDS 2022',
        );
        return view('front.icds-2022')->with($data);
    }
}
