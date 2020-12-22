<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';
    protected $fillable=['user_id','item_id','qty','price','uuid'];

}
