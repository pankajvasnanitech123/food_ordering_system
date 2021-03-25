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
        $data = Itemorder::where('status', config('constants.item_status.active'))->get();

        return View::make('orders.index')->with(compact('data'));
    }

    public function create(Request $request) {
        $activeItems = Item::where('status', config('constants.item_status.active'))->pluck('name', 'id')->toArray();

        return View::make('orders.create')->with(compact('activeItems'));
    }

    public function store(Request $request) {
        $data = new ItemOrder();
        $data->user_name = $request->user_name;
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

        $data = ItemOrder::where('id', $id)->first();

        $dataHtml = '';
        $dataHtml .= '<table class="table">';
        $dataHtml .= '<thead class="thead-dark">';
        $dataHtml .= '<tr>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
        </tr></thead>';
        $dataHtml .= '<tbody"><tr>';
        $dataHtml .= '<td>'.$data->name.'</td>';
        $dataHtml .= '<td>'.$data->stock.'</td>';
        $dataHtml .= '<td>'.show_price($data->price).'</td>';
        $dataHtml .= '<td><button type="button" class="btn btn-success">Active</button></td></tbody></table>';

        return $dataHtml;
    }

    public function delete(Request $request) {
        $id = $request->id;

        ItemOrder::where('id', $id)->delete();

        session()->flash('success', 'Order deleted successfully.');  

        return interpretJsonResponse(true, 200, null, null);
    }

    public function addMoreOrders(Request $request) {
        $nextSectionId = $request->next_section_id;
        $activeItems = Item::where('status', config('constants.item_status.active'))->pluck('name', 'id')->toArray();

        return View::make('orders.add-more-orders')->with(compact('nextSectionId', 'activeItems'));
    }
}
