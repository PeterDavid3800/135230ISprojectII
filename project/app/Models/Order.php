<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'listing_id', 'title', 'price', 'quantity', 'subtotal'];
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
