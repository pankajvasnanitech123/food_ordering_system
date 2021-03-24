<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class DashboardController extends Controller
{
    public function index(Request $request) {
        return View::make('dashboard.index');
    }
}
