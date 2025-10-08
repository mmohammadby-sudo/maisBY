<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function getCategoryWithProduct($id)
    {
        $category= Category::with('products')->find($id);

        return Response()->json($category);
    }
}
