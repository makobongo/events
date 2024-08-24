<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $consumer_key;
    private $consumer_secret;
    private $env;

    public function __construct()
    {
        $this->consumer_key = config('mpesa.credentials.consumer_key');
        $this->consumer_secret = config('mpesa.credentials.consumer_secret');
        $this->env = config('mpesa.credentials.mpesa_env');
    }
    /**
     * Generates access token
     */
    public function generateAccesstoken()
    {
        $credentials = base64_encode($this->consumer_key . ':' . $this->consumer_secret);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->env == 0 ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' : "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials, 'Content-Type: application/json; charset=utf-8']);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $response = json_decode($response);

        if ($info["http_code"] == 200) {
            $access_token = $response->access_token;
            return $access_token;
        } else {
            return false;
        }
    }
    public function initiatePayment()
    {
        // return $this->token;
        return response()->json([
            'msg'=> $this->generateAccesstoken()
        ]);
    }
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
