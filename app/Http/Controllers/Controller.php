<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;
#[OA\Info(version: '1.0.0', title: 'Laravel 12 Simple API')]
#[OA\Server(url: 'http://127.0.0.1:8000/', description: 'Local API Server')]
#[OA\SecurityScheme(securityScheme:'bearerAuth',type:'http', scheme:'bearer',bearerFormat:'JWT')]

abstract class Controller
{
 
    //
}
