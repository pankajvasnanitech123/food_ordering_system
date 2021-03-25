<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use View;

class ItemController extends Controller
{
    /**
     * Function to get the items
     * 
     * @param $request as input data
     * 
     * @return items page
     */
    public function index(Request $request) {
        $data = Item::where('status', config('constants.item_status.active'))->get();

        return View::make('items.index')->with(compact('data'));
    }

    /**
     * Function to create the item
     * 
     * @param $request as input data
     * 
     * @return items create page
     */
    public function create(Request $request) {
        return View::make('items.create');
    }

    /**
     * Function to save the item
     * 
     * @param $request as input data
     * 
     * @return items page
     */
    public function store(Request $request) {
        $data = new Item();
        $data->name = $request->name;
        $data->stock = $request->stock;
        $data->price = $request->price;

        $data->save();
        return redirect()->route('items')->with('success', 'Item added successfully.');
    }

    /**
     * Function to edit the item
     * 
     * @param $id as item id
     * 
     * @return items page
     */
    public function edit($id) {
        $data = Item::where('id', $id)->first();

        return View::make('items.edit')->with(compact('data'));
    }

    /**
     * Function to update the item
     * 
     * @param $id as item id
     * 
     * @return items page
     */
    public function update($id) {
        $data           = Item::where('id', $id)->first();
        $data->name     = request()->name;
        $data->stock    = request()->stock;
        $data->price    = request()->price;

        $data->save();
        return redirect()->route('items')->with('success', 'Item updated successfully.');
    }

    /**
     * Function to show the item details
     * 
     * @param $request as input data
     * 
     * @return items view page
     */
    public function show(Request $request) {
        $id = $request->id;

        $data = Item::where('id', $id)->first();

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

    /**
     * Function to delete the item
     * 
     * @param $request as input data
     * 
     * @return response object
     */
    public function delete(Request $request) {
        $id = $request->id;

        Item::where('id', $id)->delete();

        session()->flash('success', 'Item deleted successfully.');  

        return interpretJsonResponse(true, 200, null, null);
    }
}
