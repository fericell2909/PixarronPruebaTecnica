<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\oAuthAccessToken;
use App\User;

class AddressController extends Controller
{
    public function index($uuid)
    {

        $user = User::where('uuid',$uuid)->first();

        if($user){
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }
            $addresses = Address::where(['user_id'=>$user->id])->where(['active'=>1])->get();

            return view('dashboard.client.direcciones',compact('addresses','user','is_admin','uuid'));
        } else
        {
            return redirect('/');
        }

    }

    public function address_user($uuid){

        $user = User::where('uuid',$uuid)->with('addresses')->first();

        if($user) {
            return response()->json($user);
        } else {
            return [];
        }

    }

}
