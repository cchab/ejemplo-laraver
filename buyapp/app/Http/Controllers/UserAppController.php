<?php

namespace App\Http\Controllers;

use App\UserApp;
use Illuminate\Http\Request;

class UserAppController extends Controller
{
    public function store(Request $request){
        $inputs = $request->all();
        $uApp = new UserApp(['name'=>$inputs['name'],
            'age'=>$inputs['age'],
            'phone'=>$inputs['phone'],
            'photo'=>isset($inputs['photo']) ? $inputs['photo'] : "",
            'email'=>$inputs['email'],
            'password'=>$inputs['password']]);
        $uApp->save();
        return response()->json($uApp,200);
    }

    public function login(Request $request){
        $inputs = $request->all();
        $uApp = UserApp::where('email', $inputs['email'])->where('password',$inputs['password'])->first();
        if(isset($uApp))
            return response()->json($uApp,200);
        else
            return response()->json("No se encontraron coincidencias",404);
    }
}
