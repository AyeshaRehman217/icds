<?php

namespace App\Http\Controllers\Manager\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnsiteSubmissionType;

class OnsiteSubmissionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getIndexSubmissionTypeSelect(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = OnsiteSubmissionType::with('paymentType','users')
                ->where('onsite_submission_types.name', 'like', '%' .$search . '%')
                ->get();
        }

        return response()->json($data);

    }
}
