<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //

    private $Endpoint_posts = "/posts";

    public function paginate(Request $request){

        $client = new Client([

            'base_uri' => 'https://jsonplaceholder.typicode.com',
            'timeout'  => 2.0,
        ]);

        $response= $client->request('GET', '/posts',[]);


        if ($response->getStatusCode() !== 200) {
            return response()->json(array('results'=>[]));
        }


        $responseDecoded = json_decode($response->getBody());

        $records = array();

        foreach ($responseDecoded as $post) {
                array_push($records,array('userId' => $post->userId, 'id' => $post->id , 'title' => $post->title , 'body' => $post->body ));
        }

        //$records = json_decode(File::get(base_path('app/Http/Controllers/posts.json')), true);;


        if($request->filled("rowCount")){

            if($request->rowCount == -1){
                return response()->json($records);
            } else {
                $total = count($records);
                $number_pages = intval ($total / $request->rowCount);
                $from = ($request->current - 1 )*$request->rowCount + 1;
                $to = $request->rowCount ;

                $records = array_slice($records, $from - 1 , $request->rowCount);

                return response()->json($records);

            }

          }

    }
}
