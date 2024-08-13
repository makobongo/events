<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store()
    {
        Event::create($this->validateRequest());
        return redirect('/events');
    }

    public function update(Event $event)
    {

        $event->update($this->validateRequest());
        return redirect($event->path());
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('/events');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'publisher' => 'required'
        ]);
    }
}
