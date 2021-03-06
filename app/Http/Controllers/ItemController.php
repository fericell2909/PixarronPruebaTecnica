<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Items;

class ItemController extends Controller
{
    //
    public function index($uuid,Request $request){

        $user = User::where('uuid',$uuid)->first();

        if($user){
            $is_admin = 0;
            if($user->hasRole(config('constants.ROL_ADMIN'))){
                $is_admin = 1;
            }

            if($is_admin == 0){
                return redirect('/');
            }
            $items = Items::all();

            return view('dashboard.admin.products', [
                'user' => $user,
                'is_admin' => $is_admin,
                'uuid' => $uuid,
                'items' => $items
            ]);
        }
        else
        {
            return redirect('/');
        }
    }

    public function paginate(Request $request)
    {
        $items = Items::latest()->paginate(9);

        $response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'data' => $items
        ];

        return response()->json($response);
    }
}
