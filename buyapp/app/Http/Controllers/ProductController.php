<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        Log::info($r);
        //return response()->json($inputs);
        $provider = Provider::find($inputs['provider']);
        $product = new Product(['name' => $inputs['name'],
            'quantity' => $inputs['cantidad'],
            'stock' => $inputs['stock'],
            'type' => $inputs['tipo'],
            'unit_price' => $inputs['price']]);
        $img = $r->file('imagen');
        $extension = $img->clientExtension();
        //uploads/File_name.png
        $product->photo = 'uploads/'.$img->getFilename().'.'.$extension;

        Storage::disk('public')->put($img->getFilename().'.'.$extension,File::get($img));
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
        $img = $r->file('imagen');
        $extension = $img->clientExtension();
        //uploads/File_name.png

        Storage::disk('public')->put($img->getFilename().'.'.$extension,File::get($img));
        $product->name =  $inputs['name'];
        $product->quantity = $inputs['cantidad'];
            $product->stock = $inputs['stock'];
            $product->type = $inputs['tipo'];
            $product->unit_price = $inputs['price'];
            $product->photo='uploads/'.$img->getFilename().'.'.$extension;
        $product->save();

        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }

    public function list(Request $r){
        $res = $r->all();

        $products = Product::when(isset($res["search"]),function ($q) use ($res){
            return $q->where('name','like','%'.$res['search'].'%')
                ->orWhere('city','like','%'.$res['search'].'%')
                ->orWhere('country','like','%'.$res['search'].'%');
        })->with('provider')->get();
        return response()->json($products);
        return view('products.list',['products'=>$products]);
    }

    public function showCar(Request $r){
        $res = $r->all();
        $products = null;
        if(isset($res['products']))
            $products = Product::whereIn('id',$res['products'])->get();
        Log::info($products);
        return  response(view('products.car_shop',
            array('products'=>$products)),
            200,
            ['Content-Type' => 'application/json']);
    }


}
