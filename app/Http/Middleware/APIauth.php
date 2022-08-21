<?php

namespace App\Http\Middleware;
use App\Models\Tokenauth;
use App\Models\Authenticates;
use Closure;
use Illuminate\Http\Request;

class APIauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        $token= $request->header("token");  
        $check_token=Tokenauth::where('token',$token)
        ->where('expired_at',NULL)
        ->first(); 
        $isUser=Authenticates::where('id',$check_token->userid)->first();        
            if($isUser)  
                {   

               return $next($request);
                }    
           
        else 
        {
            return response ()->json(
                [
                    'error'=>'invalid token'
                ],404
            );
             };
       
    }
}
