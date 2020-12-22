<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
use Illuminate\Support\Str;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $uuid = Str::uuid();

        User::create([
            'name' => 'Marco Administrador',
            'email' => 'admin@devmarcoestrada.com',
            'password' => bcrypt('secret'),
            'uuid' => $uuid
        ]);

        $user = User::where('uuid',$uuid)->first();

        $user->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
