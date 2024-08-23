<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Price;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prices = Price::with('amenities')->get();
        $amenities = Amenity::with('prices')->get();
        return view('home', ['prices'=>$prices, 'amenities'=>$amenities]);
    }
}
