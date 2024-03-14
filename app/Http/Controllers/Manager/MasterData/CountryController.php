<?php

namespace App\Http\Controllers\Manager\MasterData;


use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountryIndexSelect(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;

            $data = Country::where('name', 'like', '%' . $search . '%')
                ->get();
        }

        return response()->json($data);
    }
}
