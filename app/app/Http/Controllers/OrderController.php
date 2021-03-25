<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemOrder;
use View;

class OrderController extends Controller
{
    public function index(Request $request) {
        $data = Itemorder::with('user')->where('status', config('constants.item_status.active'))->get();

        return View::make('orders.index')->with(compact('data'));
    }
}
