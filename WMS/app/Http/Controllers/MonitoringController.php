<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring;

class MonitoringController extends Controller
{
   public function index() {
    $monitorings = Monitoring::all();
    $rowCount = $monitorings->count();
    return view('monitoring.index', compact('monitorings', 'rowCount'));
   }
}