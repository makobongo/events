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
        return redirect('/events');
    }

    public function update(Event $event)
    {
        $data = request()->validate([
            'title' => 'required',
            'publisher' => 'required'
        ]);

        $event->update($data);

        return redirect('/events/' . $event->id);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('/events');
    }
}
