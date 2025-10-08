<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
 
    public function logout()
    {
        Auth::logout();
        return 'logout successflly';//may make Redirect('/');    
    }



    public function login(Request $request)
    {
        return Response()->json(['message'=>'loggedin successflly']);
    } 
    
    public function register(Request $request)
    {
        $user=User::create([
            'name'=>$request->input('name'),
            'password'=>$request->input('password'),
            'email'=>$request->input('email')
        ]);

        return Response()->json( $user);
    }
 
    public function getUsers()
    {
         $user=User::get();
    return Response()->json( $user);

    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
