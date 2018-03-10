<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;

class BlackPointController extends Controller
{
    public function index()
    {
        $blackPoint = BlackPoint::all();
    }

    public function create()
    {
        return view('blackpoints.create');
    }

    public function store(Request $request)
    {

        dd(json_decode($request['lat-lng'],true));

        $request = request()->all();

        $blackPoint = new BlackPoint();

        $blackPoint->details = $request['details'];
        $blackPoint->latitude = $request['latitude'];
        $blackPoint->longitude = $request['longitude'];


        $blackPoint->save();
    }

    public function update()
    {

    }

}
