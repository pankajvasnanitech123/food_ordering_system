<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Models\ItemOrder;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $waiterRoleId   = config('constants.user_types.waiter');
        $cashierRoleId  = config('constants.user_types.cashier');
        $adminRoleId  = config('constants.user_types.admin');

        if(auth()->user()->user_role_id == $cashierRoleId || auth()->user()->user_role_id == $adminRoleId) {
            $activeOrders = ItemOrder::where('status', config('constants.order_status.active'))->count();

            $completedOrders = ItemOrder::where('status', config('constants.order_status.completed'))->count();

            return View::make('dashboard.index')->with(compact('activeOrders', 'completedOrders'));
        } else {
            $activeOrders = ItemOrder::where('status', config('constants.order_status.active'))->count();

            return View::make('dashboard.index')->with(compact('activeOrders'));
        }
    }
}
