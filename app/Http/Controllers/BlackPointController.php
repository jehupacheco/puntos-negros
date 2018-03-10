<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;
use Carbon\Carbon;

class BlackPointController extends Controller
{
    public function index()
    {
        $blackPoints = BlackPoint::all()->map(function($item) {
            return ['lat' => (double)$item->latitude, 'lng' => (double)$item->longitude, 'id' => $item->id ];
        });

        $class = ['map-body'];

        return view('welcome', compact('blackPoints', 'class'));
    }

    public function show()
    {

        $latitude = request('lat');
        $longitude = request('lng');
        $blackPoint = BlackPoint::where('latitude', $latitude)->where('longitude', $longitude)->get();
        $blackPoint = BlackPoint::where('id',1)->get();

        $blackPoint = $blackPoint->map(function($item) {
            return [
                "detail" => $item->detail,
                "latitude" => $item->latitude,
                "longitude" => $item->longitude,
                "city" => $item->city->name,
                "status" => $item->status->name,
                "user" => $item->user->name,
                "created_at" => Carbon::parse($item->created_at)->format('d/m/Y'),
            ];
        });
        return $blackPoint[0];
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




