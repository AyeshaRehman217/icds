<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Icds2021Controller extends Controller
{
    /**
     * ICDS 2021 Highlight
     */
    public function index(){
        $data = array(
            'page_title' => 'Highlights | ICDS 2021',
        );
        return view('front.icds-2021')->with($data);
    }
}
