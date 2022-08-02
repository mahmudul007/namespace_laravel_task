<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Authenticates;


class authenticateController extends Controller
{
 
 
 //register auth
       public function Register (Request $req){

        $var = new Authenticates();
        $var ->name= $req->name;
        $var->email=$req->email;
        $var ->password=Hash::make($req->password,[
             'rounds' => 6,
        ]);
       $var->save();
 return response()->json([
                'var'=>  $var,
            ],200); 

    }
    //login 
    public function Login (Request $req){
        $error ="User name password not matched";
        
        $user = Authenticates::where('email',$req->email)->where('password',$req->password)->first();
        if($user){
            $api_token = Str::random(64);
            $token = new Token();
            $token->userid = $user->id;
            $token->token = $api_token;
            $token->save();
          
            return response()->json([
                'token'=>$token,
                'user'=>$user



            ],200
        
        );
            
        }
    }
    
}
