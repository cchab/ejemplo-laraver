<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(Request $r){
        $products = Product::all();
        return view('products.index',['products'=>$products]);
    }

    public function create(){
        $providers = Provider::all();
        //return response()->json($providers);
        return view('products.create',['providers'=>$providers]);
    }

    public function store(Request $r){
        $inputs = $r->all();
        //return response()->json($inputs);
        $provider = Provider::find($inputs['provider']);
        $product = new Product(['name' => $inputs['name'],
            'cantidad' => $inputs['cantidad'],
            'stock' => $inputs['stock'],
            'type' => $inputs['tipo'],
            'unit_price' => $inputs['price']]);

        $provider->products()->save($product);
        return redirect('/products');
    }

    public function edit($id){
        $providers = Provider::all();
        $product = Product::find($id);
        return view('products.edit',['product'=>$product,'providers'=>$providers]);
    }

    public function update($id, Request $r){
        $inputs = $r->all();
        $product = Product::find($id);
        $provider = Provider::find($inputs['provider']);
        $product->provider()->associate($provider);
        $product->save(['name' => $inputs['name'],
            'cantidad' => $inputs['cantidad'],
            'stock' => $inputs['stock'],
            'type' => $inputs['tipo'],
            'unit_price' => $inputs['price']]);

        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
