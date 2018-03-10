<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;
use Carbon\Carbon;
use Exception;

class BlackPointController extends Controller
{

    public function index()
    {
        $blackPoints = BlackPoint::all()->map(function($item) {
            return ['lat' => (double)$item->latitude, 'lng' => (double)$item->longitude];
        });

        return response()->json(compact('blackPoints'), 200);
    }

    public function show()
    {
        $latitude = request('lat');
        $longitude = request('lng');
        $blackPoint = BlackPoint::where('latitude', $latitude)->where('longitude', $longitude)->get();

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

        try{
            return response()->json($blackPoint[0], 200);
        }catch(Exception $e) {
            return response()->json(['message' => 'Hubo un error'], 400);
        }
    }

    public function create()
    {
        $cities = City::all();

        return view('blackpoints.create',compact('cities'));
    }

    public function store(Request $request)
    {
        $blackPoint = new BlackPoint();

        $blackPoint->detail = $request->detail;
        $blackPoint->latitude = $request->latitude;
        $blackPoint->longitude = $request->longitude;
        $blackPoint->city_id = $request->city;
        $blackPoint->user_id = 2;

        $blackPoint->save();

        if($blackPoint)
            return response()->json(['success' => 'true'], 200);
        else
            return response()->json(['message' => 'false'], 400);
    }

}




