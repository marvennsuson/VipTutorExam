<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Auth;
class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::where('user_id', Auth::user()->id)->get();

        return view('user.dashboard',compact('product'));
    }

    public function show(string $product)
    {
        $record =  Product::with('user')->where('id',$product)->first();
   
        return view('user.product.show',compact('record'));
    }

}
