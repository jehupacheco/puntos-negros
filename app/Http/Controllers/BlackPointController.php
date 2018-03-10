<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;
use App\Models\Status;
use Carbon\Carbon;

class BlackPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }

    public function index()
    {
        $blackPoints = BlackPoint::all()->map(function($item) {
            return [
                'lat' => (double)$item->latitude,
                'lng' => (double)$item->longitude,
                'id' => $item->id,
                'latlng' => (double)$item->latitude.(double)$item->longitude,
            ];
        })->groupBy('latlng');

        $class = ['map-body'];

        return view('welcome', compact('blackPoints', 'class'));
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
        $blackPoint->city_id = $request['city'];
        $blackPoint->user_id = \Auth::user()->id;

        $blackPoint->save();

        return redirect()->back()->with('message','El punto se ha registrado con éxito');
    }

    public function list()
    {
        $blackPoints = BlackPoint::all();

        return view('blackpoints.index',compact('blackPoints'));

    }

    public function edit(BlackPoint $blackPoint)
    {
        $cities = City::all();
        $statuses = Status::all();
        $location = json_encode(['lat' => (double)$blackPoint->latitude, 'lng' => (double)$blackPoint->longitude]);
        return view('blackpoints.edit', compact('blackPoint','cities','statuses','location'));
    }

    public function update(BlackPoint $blackPoint, Request $request)
    {
        $location = json_decode($request['lat-lng'],true);

        $latitude = $location['lat'];
        $longitude = $location['lng'];
        
        $blackPoint->detail = $request['detail'];
        $blackPoint->status_id = $request['status']; 
        $blackPoint->latitude = $latitude;
        $blackPoint->longitude = $longitude;
        $blackPoint->city_id = $request['city'];
        $blackPoint->user_id = \Auth::user()->id;
        try {
            $blackPoint->save();    
        } catch (Exception $e) {
            abort(500,$e);
        }
        
        return redirect()->back()->with('message','El punto se ha actualizado con éxito');
    }

}




