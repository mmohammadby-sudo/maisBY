<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IsUserExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('email', $request->input('email'))->first();

            if ($user &&!Hash::check($request->input('password'), $user->password)) 
            {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }


        // return Response()->json('UUUUUUSEEER EXIST');
        //auth()->User();XX
        
        else
            // return Response()->json('UUUUUUSEEER nooot EXIST');
            return $next($request);
    }
}
