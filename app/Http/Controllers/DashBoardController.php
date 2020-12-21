<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\oAuthAccessToken;

class DashBoardController extends Controller
{
    private function exists($uuid,$view){

        if(oAuthAccessToken::validate_token($uuid)){
            $user = User::where('uuid',$uuid)->first();
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }

            return view($view,compact('user','is_admin','uuid'));

        } else {
            return redirect('/');
        }

    }
    public function dashboard($uuid){

       return $this->exists($uuid,'dashboard.dashboard');

    }

    public function perfil($token) {
        return $this->exists($token,'dashboard.client.perfil');
    }

}
