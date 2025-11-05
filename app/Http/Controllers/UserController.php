<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

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



 
// {
//     #[OA\Post(
//         path: '/login',
//         summary: 'User login and get API token',
//         tags: ['Auth'],
//         requestBody: new OA\RequestBody(
//             required: true,
//             content: new OA\JsonContent(
//                 required: ['email', 'password'],
//                 properties: [
//                     new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
//                     new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123')
//                 ]
//             )
//         ),
//         responses: [
//             new OA\Response(
//                 response: 200,
//                 description: 'Login successful',
//                 content: new OA\JsonContent(
//                     type: 'object',
//                     properties: [
//                         new OA\Property(property: 'message', type: 'string', example: 'logged in successfully'),
//                         new OA\Property(property: 'token', type: 'string', example: '1|abc123tokenexample')
//                     ]
//                 )
//             ),
//             new OA\Response(response: 401, description: 'Invalid credentials')
//         ]
//     )]
    
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
    




    #[OA\Post(
        path: '/api/token',
        summary: 'Get User Token',
        tags: ['Products'],
        requestBody: new OA\RequestBody(
            required:true,
            content:new OA\JsonContent(
                type:'object',
                properties:[
                   new OA\Property(property:'email',type:'string'),
                   new OA\Property(property:'password',type:'string'),
                   new OA\Property(property:'device_name',type:'string'),
                ])),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Returne Token Successfully ',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'token', type: 'string', example: '1|abc123tokenexample')
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Invalid credentials')
        ]
    )]
    public function token(Request $request){
         $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials.'
        ], 401);
    }

    // Delete old tokens 
    $user->tokens()->where('name', $request->device_name)->delete();

    // Create new token
    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
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
