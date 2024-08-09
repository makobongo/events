<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function store()
    {
        Publisher::create([
            'fname' => request('fname'),
            'sname' => request('sname'),
            'dob' => request('dob')
        ]);
    }
}
