<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'fname' => 'required',
            'sname' => 'required'
        ]);
        Publisher::create($data);
    }

    public function update(Publisher $publisher)
    {
        $data = request()->validate([
            'fname' => 'required',
            'sname' => 'required'
        ]);

        $publisher->update($data);
    }
}
