<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create(){
        $p = Product::all();
        return view('purchase.create',['products'=>$p]);
    }
}
