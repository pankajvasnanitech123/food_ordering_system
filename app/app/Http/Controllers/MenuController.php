<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class MenuController extends Controller
{
    /**
     * Function to get the food menu
     * 
     * @param $request as input data
     * 
     * @return food menu data
     */
    public function index(Request $request) {
        $data = Item::where('status', config('constants.item_status.active'))->orderBy('created_at', 'desc')->get();

        return interpretJsonResponse(true, 200, $data, null);
    }
}
