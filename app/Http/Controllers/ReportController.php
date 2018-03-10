<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data =  DB::table('black_points')
                        ->select(DB::raw('count(*) as count, black_points.city_id, cities.name'))
                        ->leftJoin('cities', 'cities.id', '=', 'black_points.city_id')
                        ->groupBy(['city_id', 'cities.name'])
                        ->get();

        return view('reports.index', compact('data'));
    }

    public function byDepartment(City $city)
    {
        $data =  DB::table('black_points')
                ->select(DB::raw('count(*) as count, black_points.city_id, cities.name'))
                ->leftJoin('cities', 'cities.id', '=', 'black_points.city_id')
                ->groupBy(['city_id', 'cities.name'])
                ->get();

        return view('reports.department', compact('data'));
    }

}




