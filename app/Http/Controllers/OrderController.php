<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\User;

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

}
