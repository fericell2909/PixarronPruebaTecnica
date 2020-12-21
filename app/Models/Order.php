<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function client()
    {
        return $this->hasOne('App\User', 'id', 'client_id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Items', 'order_has_items', 'order_id', 'item_id');
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address', 'id', 'address_id');
    }
}
