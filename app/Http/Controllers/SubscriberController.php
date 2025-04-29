<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe()
    {
        // dd(request()->all());
        $subscriber = request()->validate([
            'email'=>'email|required',
            'phone'=>'required|numeric'
        ]);
        Subscriber::create($subscriber);
        return redirect()->back();
    }
}
