<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function usuarios($uuid){

        $user = User::where('uuid',$uuid)->first();

        if($user){

            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }

            $users = User::orderBy('created_at', 'desc');

            $users = $users->paginate(env('PAGINATE',10));

            return view('dashboard.admin.users',compact('user','is_admin','uuid','users'));

        } else
        {
            return redirect('/');
        }

    }

    public function usuarios_direcciones($uuid){

        $user = User::where('uuid',$uuid)->first();

        if($user){
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            } else {
                return redirect('/');
            }

            $users = User::orderBy('created_at', 'desc');

            $users = $users->paginate(env('PAGINATE',10));

            $records = User::whereIn('id',$users->pluck('id'))->with('addresses')->get();

                return view('dashboard.admin.users-address', [
                    'users'     => $users,
                    'parameters' => count($_GET) != 0,
                    'user' => $user,
                    'is_admin' => $is_admin,
                    'uuid' => $uuid,
                    'records' => $records
                ]);


        } else {
            return redirect('/');
        }

    }

}
