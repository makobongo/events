<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function store()
    {
        Publisher::create($this->validateRequest());
    }

    public function update(Publisher $publisher)
    {
        $publisher->update($this->validateRequest());
    }

    protected function validateRequest()
    {
        return  request()->validate([
            'fname' => 'required',
            'sname' => 'required'
        ]);
    }
}
