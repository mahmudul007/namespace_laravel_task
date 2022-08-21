<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Authenticates;
use App\Models\Tokenauth;
use DateTime;

class authenticateController extends Controller
{
 
 
 //register auth
       public function Register (Request $req){

        $var = new Authenticates();
        
        $var ->name= $req->name;
        $var->email=$req->email;
        $var ->password= Hash::make($req->password);
       $var->save();
 return response()->json([
                'var'=>  $var,
            ],200)
            
            ; 

    }
    //login 
    public function Login (Request $req){
       try{
       $email= $req->email;
       $password=$req->password;
       $user = Authenticates::where('email',$email)->first();
        
        if($user){
            if(Hash::check($req->password, $user->password))
          { 
             $api_token = Str::random(64);
            $token = new Tokenauth();
            $token->userid = $user->id;
            $token->token = $api_token;
            $token->created_at = new DateTime(); 
            $token->ip=$req -> getClientIp();    
            $token->save();
          
            return response()->json([
                'message' => 'User login successfully',
                'authtoken'=>$token,
                'user'=>$user
            ],200
        
        );}
            
        }
       }
 catch(\Exception $exception){
 
           return response([
                'message'=>$exception->getMessage()
            ],400);
            }      
      return response([
            'message'=>"Login Failed"
        ],401);   
    }

    //logout from database by update creating updating
    public function Logout (Request $request ){
        try{
              $token = Tokenauth::where('token', $request->header('token'))->first();
              $token->expired_at =  new DateTime();
        
          if($token->save()){
            return response()->json(
                [
                    'message'=>'logout successfully',
                ],
                200
            );           
          }
        }
        catch (\Exception $exception){
               return response([
                'message'=>$exception->getMessage()
            ],400);
            
        }
      
    }



    public function Ip (Request $req){
        try{
       $address= $req->ip();
        $two = $req -> getClientIp();
        return response()->json([
                'address'=>  $address,
            ],200); 
        }
  
            catch(\Exception $exception){
           return response([
                'message'=>$exception->getMessage()
            ],400);
            }
        
        
     

    }
    
}
