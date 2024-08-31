<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\Price;
use App\Models\Setting;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Venue;
use Alert;
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
        // alert()->warning('Are you over 18?','To choose to proceed on our website, you have confirmed.');
        $prices = Price::with('amenities')->get();
        $amenities = Amenity::with('prices')->get();
        $venues = Venue::all();
        $speakers = Speaker::all();
        $galleries = Gallery::all();
        $sponsors = Sponsor::all();
        $hotels = Hotel::all();
        $settings = Setting::pluck('value', 'key');
        $faqs = Faq::all();
        return view('home', ['prices' => $prices, 'amenities' => $amenities, 'venues' => $venues, 'speakers' => $speakers, 'galleries' => $galleries, 'sponsors' => $sponsors, 'hotels' => $hotels, 'settings' => $settings, 'faqs' => $faqs]);
    }
}
