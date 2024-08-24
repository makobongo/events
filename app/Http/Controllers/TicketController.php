<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store()
    {
        dd(request()->all());
        // $ticket = request()->validate([
        //     'name' => 'require',
        //     'phone' => 'require',
        //     'package_name' => 'require',
        //     'package_cost' => 'require'
        // ]);

        // Ticket::create($ticket);
        // return redirect('/');
    }
}
