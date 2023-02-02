<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class indexController extends Controller
{
    
    public function categories(Request $request){
        $categories = DB::table('categories')->get();
        return response()->json($categories);
    }
    public function featured_products(Request $request){
        $featured = DB::table('products')->where('featured', '1')->get();
        return response()->json($featured);
    }

}
