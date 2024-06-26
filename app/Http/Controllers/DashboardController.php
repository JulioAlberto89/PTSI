<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $holidays = Holiday::all();
        return view('dashboard', compact('holidays'));
    }
}
