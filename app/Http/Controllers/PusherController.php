<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function chatIndex() {
        return view('front.chatIndex');
    }

    public function broadcast(Request $request) {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        return view('front.broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request) {
        return view('front.receive', ['message' => $request->get('message')]);
    }
}
