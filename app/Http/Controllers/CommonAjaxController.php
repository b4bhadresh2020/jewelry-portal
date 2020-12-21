<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class CommonAjaxController extends Controller
{
    public function __construct()
    {

    }

    public function getState(Request $request)
    {
        $data['states'] = State::select("name", "id")
            ->where("country_id", $request->country_id)
            ->where('flag', 1)
            ->get();
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::select("name", "id")
            ->where("state_id", $request->state_id)
            ->where('flag', 1)
            ->get();
        return response()->json($data);
    }
}
