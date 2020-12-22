<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Items;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index($uuid, Request $request)
    {
        $user = User::where('uuid',$uuid)->first();

        if($user){
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }

            if($is_admin == 0){
                $orders = Order::where(['client_id' => $user->id])->orderBy('created_at', 'desc');
            } else{
                $orders = Order::orderBy('created_at', 'desc');
            }


        //BY DATE FROM
            if (isset($_GET['fromDate']) && strlen($_GET['fromDate']) > 3) {
                //$start = Carbon::parse($_GET['fromDate']);
                $orders = $orders->whereDate('created_at', '>=', $_GET['fromDate']);
            }

            //BY DATE TO
            if (isset($_GET['toDate']) && strlen($_GET['toDate']) > 3) {
                //$end = Carbon::parse($_GET['toDate']);
                $orders = $orders->whereDate('created_at', '<=', $_GET['toDate']);
            }

            $orders = $orders->paginate(env('PAGINATE',10));

            if($is_admin == 0){
                return view('dashboard.client.ordenes', [
                    'orders'     => $orders,
                    'parameters' => count($_GET) != 0,
                    'user' => $user,
                    'is_admin' => $is_admin,
                    'uuid' => $uuid
                ]);
            } else {
                return view('dashboard.admin.ordenes', [
                    'orders'     => $orders,
                    'parameters' => count($_GET) != 0,
                    'user' => $user,
                    'is_admin' => $is_admin,
                    'uuid' => $uuid

                ]);
            }

        }
    }

    public function ordenes_usuario($uuid, Request $request){

        $user = User::where('uuid',$uuid)->first();

        if($user){
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }


            $orders = Order::orderBy('created_at', 'desc');
            $users = User::all();

            //BY CLIENT
            if($request->filled('client_id')){

                $user = User::where('uuid',$request->client_id)->first();

                $orders = $orders->where('client_id',$user->id);

            }

            $orders = $orders->paginate(env('PAGINATE',10));

                return view('dashboard.admin.ordenes-user', [
                    'orders'     => $orders,
                    'parameters' => count($_GET) != 0,
                    'user' => $user,
                    'is_admin' => $is_admin,
                    'uuid' => $uuid,
                    'users' => $users
                    ]);
        }

    }

    public function register_order($uuid, Request $request) {

        $user = User::where('uuid',$uuid)->first();

        if($user){

            $records =  Cart::where('user_id',$user->id)->get();
            $price = 0;


            if($request->address == "") {

                $address_id = $request->address_id;

            } else {

                $address = new Address();

                $address->address = $request->address;
                $address->reference = $request->address;
                $address->active = 1;
                $address->user_id = $user->id;
                $address->lat = 0.000000;
                $address->lng = 0.000000;
                $address->save();

                $address_id = $address->id;

            }


            if(count($records) > 0) {

                $uuid = Str::uuid();

                $order = new Order;

                $order->uuid = $uuid;


                $order->client_id = $user->id;
                $order->address_id = $address_id;
                $order->created_at = now();
                $order->updated_at = now();
                $order->order_price = $price;
                $order->payment_method = 'Contra Entrega';
                $order->payment_status = 'registrado';
                $order->active = 1;
                $order->comment = '';

                $order->save();

                foreach($records as $record){

                        $Orderdet = new OrderDetails;
                        $Orderdet->order_id = $order->id;
                        $Orderdet->item_id = $record['item_id'];

                        $item = Items::where('id',$record['item_id'])->first();

                        if($item) {
                            $Orderdet->price = $item->price;
                        } else {
                            $Orderdet->price = 0;
                        }
                        $item = null;

                        $Orderdet->qty = $record['qty'];
                        $Orderdet->created_at = now();
                        $Orderdet->updated_at = now();
                        $Orderdet->save();


                        $price = $price + $Orderdet->price;

                        $Orderdet = null;
                }

                // borrando registros del Carrito;

                DB::table('cart')->where('user_id',$user->id)->delete();


                Order::where('id', $order->id)->update(['order_price' => $price]);

                return response()->json([
                    'message' => 'Orden Creada Correctamente',
                    'status' => true
                ]);

            } else {

                return response()->json([
                    'message' => 'Orden no ha sido creada',
                    'status' => false
                ]);

            }





        } else {

            return response()->json([
                'message' => 'Orden no ha sido creada',
                'status' => false
            ]);
        }

    }

}
