<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'publisher' => 'required'
        ]);
        Event::create($data);
    }
}
