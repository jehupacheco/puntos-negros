<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;

class BlackPointController extends Controller
{
    public function index()
    {
        $blackPoints = BlackPoint::all()->map(function($item) {
            return ['lat' => (double)$item->latitude, 'lng' => (double)$item->longitude ];
        });

        $class = ['map-body'];

        return view('welcome', compact('blackPoints', 'class'));
    }

    public function show()
    {
        return true;
    }

    public function create()
    {
        $cities = City::all();

        return view('blackpoints.create',compact('cities'));
    }

    public function store(Request $request)
    {
        $location = json_decode($request['lat-lng'],true);

        $latitude = $location['lat'];
        $longitude = $location['lng'];

        $request = request()->all();

        $blackPoint = new BlackPoint();

        $blackPoint->detail = $request['detail'];
        $blackPoint->latitude = $latitude;
        $blackPoint->longitude = $longitude;

        dd($blackPoint);

        $blackPoint->save();
    }

    public function update()
    {

    }

}




