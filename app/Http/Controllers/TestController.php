<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Str;





class TestController extends Controller
{
   public function test(Request  $request) {
    $test ='hello bangladesh laravel';
    return response()->json([
                'test'=>  $test,
            ],200);       
}
public function linkStore(Request $req){

    $req->validate([
    'link' => 'required',
]);
$var = new Test();
 $var->link=$req->link;
 $var -> shortlink=Str::random(6);
 $var->save();
 return response()->json([
                'var'=>  $var,
            ],200); 

}
   public function shortlInk($shortlink)
    {
        $res = Test::where('shortlink',$shortlink)->first();
        return response()->json([
                'res'=> ( $res),
            ],200); 
       
    }
    public function all ()
    {
        $res = Test :: all();
        return response ()->json([
            'res'=>($res),
        ],200);
    }

    

    

}
