<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Consultation;
use App\Models\Faq;
use App\Models\Info;
use App\Models\Problem;
use App\Models\Product;
use App\Models\Usage;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public static function index()
    {
        
        $product = Product::first();
        $problem = Problem::first();
        $cause = Cause::first();
        $usage = Usage::first();
        $faq = Faq::first();
        $consultation = Consultation::first();
        $info = Info::first();
        
        return view('front.index', compact('product','problem','cause','usage','faq','consultation','info'));
    }
}
