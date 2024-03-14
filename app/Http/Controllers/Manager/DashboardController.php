<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AbstractSubmission;
use App\Models\UserRegistration;

class DashboardController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        $user = UserRegistration::get();
        $userCount = $user->count();
        // dd($userCount);
        $abstract = AbstractSubmission::get();
        $abstractCount = $abstract->count();
        $data = array(
            'page_title' => 'Dashboard',
            'p_title' => 'Dashboard',
            'userCount' => $userCount,
            'abstractCount' => $abstractCount,
        );
        return view('manager.dashboard')->with($data);
    }
}
