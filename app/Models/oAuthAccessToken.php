<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class oAuthAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';

    public static function validate_token($uuid){

        $exist = User::where('uuid',$uuid)->first();
        if($exist) {
            return true;
        } else {
            return false;
        }
    }
}
