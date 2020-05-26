<?php

namespace App\Http\Controllers;

use App\Event;
use App\UserApp;
use Carbon\Carbon;
use http\Client\Curl\User;
use http\Env\Response;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $r){
        $inputs = $r->all();
        $user = UserApp::find($inputs['user_app_id']);
        $event = new Event(['title'=>$inputs['title'],
            'description'=>$inputs['description'],
            'type'=>$inputs['type'],
            'date'=>Carbon::createFromFormat('d/m/Y', $inputs['date']),
            'time'=> date("H:i", strtotime($inputs['time'])),
            'score'=>$inputs['score']]);
        $event->UserApp()->associate($user);
        $event->save();
        return response()->json($event);
    }

    public function show($userId){
        $events = Event::where('user_app_id',$userId)->get();
        return response()->json($events);
    }

    public function update($id, Request $request){
        $event = Event::find($id);
        $inputs = $request->all();
        $event->title = $inputs['title'];
        $event->description = $inputs['description'];
        $event->type = $inputs['type'];
        $event->date = Carbon::createFromFormat('d/m/Y', $inputs['date']);
        $event->time = date("H:i", strtotime($inputs['time']));
        $event->save();

        return response()->json($event);
    }

    public function delete($id){
        $event = Event::find($id);
        $event->delete();
        return response()->json("Correcto",200);
    }
}
