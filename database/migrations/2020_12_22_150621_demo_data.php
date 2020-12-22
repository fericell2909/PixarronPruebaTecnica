<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Models\Address;
use App\Models\Cart;


class DemoData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $items = json_decode(File::get(base_path('database/migrations/json/items.json')), true);
        $users = json_decode(File::get(base_path('database/migrations/json/users.json')), true);
        $address = json_decode(File::get(base_path('database/migrations/json/address.json')), true);

        // creando productos

        $total_reg_items = count($items);

        foreach ($items as $item) {

            DB::table('items')->insert([
                'name' => $item['name'],
                'description' => $item['description'],
                'uuid' => Str::uuid(),
                'active' => 1,
                'price' => $item['price'],
                'image' => $item['image'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }

        // creando usuarios
        foreach ($users as $user) {

            $uuid  = Str::uuid();

            $exist = User::where('email' , $user["email"])->get();

            if(count($exist) <= 0){
                User::create([
                    'name' => $user["name"],
                    'email' => $user["email"],
                    'password' => bcrypt('secret'),
                    'uuid' => $uuid
                ]);

                $user = User::where('uuid',$uuid)->first();

                $user->assignRole('client');

                 // generando direcciones

                 if(count($address) > 0 ) {

                    $pos = random_int(1, count($address));

                    Address::create([

                        'address' => $address[$pos - 1]["address"],
                        'reference' => $address[$pos - 1]["reference"],
                        'active' => 1,
                        'user_id' => $user->id,
                        'lat' => 0.000000 ,
                        'lng' => 0.000000
                    ]);


                 }

                 // generando carrito de compra

                 if ($total_reg_items > 0) {
                    $rand_regs = random_int(1, 5);
                    $rand_item_position = random_int(1, $total_reg_items);

                    for($i = 1 ; $i<= $rand_regs ; $i++){
                        $str_uuid = Str::uuid();

                        Cart::create([
                            'user_id' => $user->id,
                            'item_id' => $rand_item_position - 1 ,
                            'qty' => 1,
                            'uuid' => $str_uuid
                        ]);

                    }

                 }

            }
        }

    }

    public function down()
    {
        //
    }
}
