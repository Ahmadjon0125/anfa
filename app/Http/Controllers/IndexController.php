<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Problem;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public static function index()
    {
        
        $product = Product::first();
        $problem = Problem::first();
        $cause = Cause::first();
        
        return view('front.index', compact('product','problem','cause'));
    }
}
