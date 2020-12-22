<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\User;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function getItems($uuid,Request $request ){

        $user = User::where('uuid',$uuid)->first();

        if($user){

            $cart = Cart::select("items.image","cart.qty as quantity", "items.price","cart.id","cart.uuid","cart.item_id","items.name","items.description","cart.qty")
                                ->where('user_id',$user->id)
                                ->join('items','items.id','=','cart.item_id')->get();

            return response()->json($cart);

        }

    }
    public function increment($uuid,Request $request)
    {

        $user = User::where('uuid',$uuid)->first();

        if($user){

            if($request->cart_uuid == ""){
                return response()->json(["status"=>0,"message"=>"Codigo de Carrito es requerido"],400);
            }
            if($request->item_id == ""){
                return response()->json(["status"=>0,"message"=>"Producto es requerido"],400);
            }

            $cartdata = Cart::where('cart.uuid', $request->cart_uuid)->first();

            if($cartdata){
                Cart::where('cart.uuid', $request->cart_uuid)->update(array('qty' => $cartdata->qty + 1 ));
            }

            return response()->json(['status'=> 1,'message'=>'Cantidad ha sido actualizada'],200);

        } else {

            return response()->json(['status'=> 0,'message'=>'Cantidad no actualizada'],200);

        }
    }

    public function decrement($uuid,Request $request)
    {

        $user = User::where('uuid',$uuid)->first();

        if($user){

            if($request->cart_uuid == ""){
                return response()->json(["status"=>0,"message"=>"Codigo de Carrito es requerido"],400);
            }
            if($request->item_id == ""){
                return response()->json(["status"=>0,"message"=>"Producto es requerido"],400);
            }

            $cartdata = Cart::where('cart.uuid', $request->cart_uuid)->first();

            if($cartdata){
                if($cartdata->qty <= 1)  {
                    return response()->json(['status'=> 0,'message'=>'La Cantidad es igual a 1. No se puede disminuir'],200);

                } else {
                    Cart::where('cart.uuid', $request->cart_uuid)->update(array('qty' => $cartdata->qty - 1 ));
                    return response()->json(['status'=> 1,'message'=>'Cantidad ha sido actualizada'],200);
                }

            }



        } else {

            return response()->json(['status'=> 0,'message'=>'Cantidad no actualizada'],200);

        }
    }

    public function deletecartitem($uuid,Request $request)
    {
        $user = User::where('uuid',$uuid)->first();

        if($user){

            if($request->cart_uuid == ""){
                return response()->json(["status"=>0,"message"=>"Carrito es requerido"],400);
            }

            Cart::where('uuid', $request->cart_uuid)->delete();

            return response()->json(['status'=> 1,'message'=>'Producto Eliminado'],200);

        } else {

            return response()->json(['status'=> 0,'message'=>'Producto no Eliminado'],200);
        }

    }

    public function addcartitem($uuid,Request $request)
    {
        $user = User::where('uuid',$uuid)->first();

        if($user){

            if($request->item_id == ""){
                return response()->json(["status"=>0,"message"=>"Carrito es requerido"],400);
            }

            $exist = Cart::where('item_id',$request->item_id)->where('user_id',$user->id)->first();

            if($exist){

                return response()->json(['status'=> 0,'message'=>'Producto ya existe , debe actualizar'],200);

            } else {

                $cart = new Cart();
                $cart->uuid = Str::uuid();
                $cart->item_id = $request->item_id;
                $cart->user_id = $user->id;
                $cart->qty = 1;

                $cart->save();

                return response()->json(['status'=> 1,'message'=>'Producto Agregado Correctamente'],200);

            }

        } else {

            return response()->json(['status'=> 0,'message'=>'Producto no Agregado Correctamente'],200);
        }

    }
}
