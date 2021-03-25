<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;

class ItemOrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "item_orders_details";

    protected $appends = ['item_name'];

    public function getItemNameAttribute() {
        $itemDetails = Item::where('id', $this->item_id)->select('name')->first();

        return $itemDetails->name;
    }
}
