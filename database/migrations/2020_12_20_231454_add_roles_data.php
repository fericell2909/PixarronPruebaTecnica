<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use App\User;

class AddRolesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       Role::create(['name' => config('constants.ROL_ADMIN')]);

        $admin = new User;
        $admin->name = 'Marco Estrada';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('secret');
        $admin->uuid= Str::uuid();
        $admin->save();

        $admin->assignRole(config('constants.ROL_ADMIN'));

        Role::create(['name' => config('constants.ROL_CLIENT')]);


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
