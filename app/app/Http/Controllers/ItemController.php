<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use View;

class ItemController extends Controller
{
    public function index(Request $request) {
        $data = Item::where('status', config('constants.item_status.active'))->get();

        return View::make('items.index')->with(compact('data'));
    }
}
