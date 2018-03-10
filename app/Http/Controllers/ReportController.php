<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackPoint;
use App\Models\City;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blackPoints = BlackPoint::all()->map(function($item) {
            return ['lat' => (double)$item->latitude, 'lng' => (double)$item->longitude, 'id' => $item->id ];
        });

        $class = ['map-body'];

        return view('reports.index', compact('blackPoints', 'class'));
    }

}




