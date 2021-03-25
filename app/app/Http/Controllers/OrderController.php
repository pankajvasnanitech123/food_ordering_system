<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemOrder;
use App\Models\Item;
use App\Models\ItemOrderDetail;
use View;

class OrderController extends Controller
{
    public function index(Request $request) {
        if(auth()->user()->user_role_id == config('constants.user_types.waiter')) {
            $data = Itemorder::where('staff_id', auth()->user()->id)->get();
        } else {
            $data = Itemorder::get();
        }

        return View::make('orders.index')->with(compact('data'));
    }

    public function create(Request $request) {
        $activeItems = Item::where('status', config('constants.item_status.active'))->pluck('name', 'id')->toArray();

        return View::make('orders.create')->with(compact('activeItems'));
    }

    public function store(Request $request) {
        $data = new ItemOrder();
        $data->table_number = $request->table_number;
        $data->user_name = $request->user_name;
        $data->staff_id = auth()->user()->id;
        $data->order_number = generate_order_number();
        
        $data->save();
        $orderId = $data->id;

        foreach($request->order_details as $val) {
            $detailObj = new ItemOrderDetail();
            $detailObj->order_id = $orderId;
            $detailObj->item_id = $val['item_id'];
            $detailObj->quantity = $val['quantity'];
            $detailObj->price = $val['price'];
            $detailObj->final_price = $val['price'] * $val['quantity'];

            $detailObj->save();
        }

        $data->save();

        return redirect()->route('orders')->with('success', 'Order added successfully.');
    }

    public function edit($id) {
        $activeItems = Item::where('status', config('constants.item_status.active'))->pluck('name', 'id')->toArray();

        $data = ItemOrder::where('id', $id)->first();

        $orderDetails = ItemOrderDetail::where("order_id", $id)->get();

        return View::make('orders.edit')->with(compact('data', 'orderDetails', 'activeItems'));
    }

    public function update($id) {
        $data = ItemOrder::where('id', $id)->first();
        $data->user_name = request()->user_name;
        $data->table_number = request()->table_number;
        
        $data->save();
        $orderId = $data->id;

        ItemOrderDetail::where('order_id', $orderId)->delete();

        foreach(request()->order_details as $val) {
            $detailObj = new ItemOrderDetail();
            $detailObj->order_id = $orderId;
            $detailObj->item_id = $val['item_id'];
            $detailObj->quantity = $val['quantity'];
            $detailObj->final_price = $val['price'] * $val['quantity'];
            $detailObj->price = $val['price'];

            $detailObj->save();
        }

        $data->save();

        return redirect()->route('orders')->with('success', 'Order updated successfully.');
    }

    public function show(Request $request) {
        $id = $request->id;

        $data = ItemOrderDetail::where('order_id', $id)->get();

        $dataHtml = '';
        $dataHtml .= '<table class="table">';
        $dataHtml .= '<thead class="thead-dark">';
        $dataHtml .= '<tr>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Final Price</th>
        </tr></thead>';
        $dataHtml .= '<tbody">';

        $totalPrice = 0;

        foreach($data as $val) {
            $dataHtml .= '<tr">';
            $dataHtml .= '<td>'.$val->item_name.'</td>';
            $dataHtml .= '<td>'.$val->quantity.'</td>';
            $dataHtml .= '<td>'.show_price($val->price).'</td>';
            $dataHtml .= '<td>'.show_price($val->final_price).'</td>';
            $dataHtml .= '</tr>';

            $totalPrice += $val->final_price;
        }
        $dataHtml .= '</tbody>';

        $dataHtml .= '<thead class="thead-dark"><tr>
            <th scope="col" colspan="3">Grand Total</th>
            <th scope="col">'.show_price($totalPrice).'</th>
        </tr></thead>';

        $dataHtml .= '</table>';

        return $dataHtml;
    }

    public function delete(Request $request) {
        $id = $request->id;

        ItemOrder::where('id', $id)->delete();

        ItemOrderDetail::where('order_id', $id)->delete();

        session()->flash('success', 'Order deleted successfully.');  

        return interpretJsonResponse(true, 200, null, null);
    }

    public function addMoreOrders(Request $request) {
        $nextSectionId = $request->next_section_id;
        $activeItems = Item::where('status', config('constants.item_status.active'))->pluck('name', 'id')->toArray();

        return View::make('orders.add-more-orders')->with(compact('nextSectionId', 'activeItems'));
    }

    public function processOrder(Request $request) {
        $id = $request->id;

        ItemOrder::where('id', $id)->update(['status' => config('constants.order_status.completed')]);

        session()->flash('success', 'Order processed successfully.');  

        return interpretJsonResponse(true, 200, null, null);
    }
}
