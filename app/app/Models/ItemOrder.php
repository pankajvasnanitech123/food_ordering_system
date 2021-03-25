<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemOrderDetail;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['total_price'];

    public function getTotalPriceAttribute() {
        $totalPrice = ItemOrderDetail::where('order_id', $this->id)->sum('final_price');

        return $totalPrice;
    }
}
