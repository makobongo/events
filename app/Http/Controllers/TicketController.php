<?php

namespace App\Http\Controllers;

use App\Mail\sendClientMail;
use App\Mail\sendMail;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use AfricasTalking\SDK\AfricasTalking;
use App\Mail\sendPaymentNotification;

class TicketController extends Controller
{
    private $consumer_key;
    private $consumer_secret;
    private $env;
    private $mpesa_stkpush_url;
    private $pass_key;
    private $call_back_url;
    private $primary_email;
    private $secondary_emails;

    public function __construct()
    {
        $this->consumer_key = config('mpesa.credentials.consumer_key');
        $this->consumer_secret = config('mpesa.credentials.consumer_secret');
        $this->env = config('mpesa.credentials.mpesa_env');
        $this->mpesa_stkpush_url = config('mpesa.credentials.mpesa_stkpush_url');
        $this->pass_key = config('mpesa.credentials.pass_key');
        $this->call_back_url = config('mpesa.credentials.call_back_url');
        $this->primary_email = config('mailinglist.credentials.primary_email');
        $this->secondary_emails = config('mailinglist.credentials.secondary_emails');
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
    public function lipaNaMpesaOnline()
    {
        if (Client::where('phone', request()->phone)->exists()) {
            $ticket = explode(',', request()->ticket);
            $name_of_ticket = $ticket[1];
            $cost_of_a_ticket = (int) $ticket[0];
            $number_of_tickets = request()->number_of_tickets;
            $ticket_cost = $cost_of_a_ticket * $number_of_tickets;
            Client::where('phone', request()->phone)->update([
                'email' => request()->email,
                'number_of_ticket' => request()->number_of_tickets,
                'name_of_ticket' => $name_of_ticket,
                'ticket_cost' => $ticket_cost,
            ]);
            $this->stkPush();
            alert()->info(env('APP_NAME'), 'Check your phone to process payment');
            return redirect()->back();
        } else {
            $ticket = explode(',', request()->ticket);
            $name_of_ticket = $ticket[1];
            $cost_of_a_ticket = (int) $ticket[0];
            $number_of_tickets = request()->number_of_tickets;
            $ticket_cost = $cost_of_a_ticket * $number_of_tickets;
            Client::create([
                'first_name' => request()->first_name,
                'second_name' => request()->second_name,
                'email' => request()->email,
                'phone' => request()->phone,
                'number_of_ticket' => $number_of_tickets,
                'name_of_ticket' => $name_of_ticket,
                'ticket_cost' => $ticket_cost,
            ]);
            $this->stkPush();
            alert()->info(env('APP_NAME'), 'Check your phone to process payment');
            return redirect()->back();
        }
    }

    public function mpesaConfirmation()
    {
        $content = file_get_contents('php://input');
        Storage::disk('local')->put('test.txt', request()->getContent());
        $data = json_decode($content, true);
        if(!is_null($data)){
            Payment::create([
                'TransactionType' => $data['TransactionType'],
                'TransID' => $data['TransID'],
                'TransTime' => date('Y-m-d H:i:s', strtotime($data['TransTime'])),
                'TransAmount' => $data['TransAmount'],
                'BusinessShortCode' => $data['BusinessShortCode'],
                'BillRefNumber' => $data['BillRefNumber'],
                'InvoiceNumber' => $data['InvoiceNumber'],
                'OrgAccountBalance' => $data['OrgAccountBalance'],
                'ThirdPartyTransID' => $data['ThirdPartyTransID'],
                'MSISDN' => $data['MSISDN'],
                'FirstName' => $data['FirstName'],
                // 'MiddleName' => $data['MiddleName'],
                // 'LastName' => $data['LastName'],
                'ticket_number' => env('ACCOUNT_INIT') . '-' . $data['TransID'],
                'ticket_is_valid' => true
            ]);
            Mail::to($this->primary_email)
            // ->cc(['stevewanjau@sixx-spirits.com', 'wambuiwanjau@sixx-spirits.com', 'winniemaina@sixx-spirits.com'])
            ->send(new sendPaymentNotification($data));
        } else {
            return response()->json([
                'msg'=> 'No data available'
            ]);
        }
        // $content = json_decode(request()->getContent(), true);
        // return response()->json([
        //     'msg'=>$content['TransactionType']
        // ]);
        // if (!is_null($content)) {
        //     Payment::create([
        //         'TransactionType' => $content['TransactionType'],
        //         'TransID' => $content['TransID'],
        //         'TransTime' => date('Y-m-d H:i:s', strtotime($content['TransTime'])),
        //         'TransAmount' => $content['TransAmount'],
        //         'BusinessShortCode' => $content['BusinessShortCode'],
        //         'BillRefNumber' => $content['BillRefNumber'],
        //         'InvoiceNumber' => $content['InvoiceNumber'],
        //         'OrgAccountBalance' => $content['OrgAccountBalance'],
        //         'ThirdPartyTransID' => $content['ThirdPartyTransID'],
        //         'MSISDN' => $content['MSISDN'],
        //         'FirstName' => $content['FirstName'],
        //         'MiddleName' => $content['MiddleName'],
        //         'LastName' => $content['LastName'],
        //         'ticket_number' => env('ACCOUNT_INIT') . '-' . $content['TransID'],
        //         'ticket_is_valid' => true
        //     ]);
        // $client = Client::where('phone', '0' . substr($content['MSISDN'], -9, 12))->first();
        // $data = [
        //     'first_name' => $client->first_name,
        //     'last_name' => $client->last_name,
        //     'phone' => $client->phone,
        //     'number_of_ticket' => $client->number_of_ticket,
        //     'name_of_ticket' => $client->name_of_ticket,
        //     'ticket_cost' => $client->ticket_cost,
        // ];
        // $this->generatePDF($data);
        // $filePath = public_path($data['phone'] . '.pdf');
        // if ($client->name_of_ticket == "Early Bird Ticket") {
        //     Mail::to($this->primary_email)
        //         ->send(new sendMail($data, $filePath));
        // }
        // if ($client->name_of_ticket == "Regular Ticket") {
        //     Mail::to($this->primary_email)
        //         ->send(new sendMail($client, $filePath));
        // }
        // if ($client->name_of_ticket == "Group Ticket") {
        //     Mail::to($this->primary_email)
        //         ->send(new sendMail($client, $filePath));
        // }
        // $data = [
        //     'title' => env('ACCOUNT_INIT') . ' EVENT TICKET',
        //     'first_name' => $content['FirstName'],
        //     'second_name' => $content['LastName'],
        //     'phone' => $content['MSISDN'],
        //     'ticket_code' => env('ACCOUNT_INIT') . '-' . $content['TransID'],
        //     'paid_amount' => $content['TransAmount']
        // ];
        // $pdf = PDF::loadView('pdf.ticket', $data)->setPaper([0, 0, 396, 612], 'landscape');
        // $pdf->render();
        // file_put_contents($content['TransID'] . '.pdf', $pdf->output());
        // $filePath = public_path($content['TransID'] . '.pdf');
        // // //sending email
        // Mail::to($this->primary_email)
        //     // ->cc(explode(",",$this->secondary_emails))
        //     ->send(new sendMail($content, $filePath));
        // // response
        // return response()->json([
        //     'msg' => 'success'
        // ]);
        // } else {
        //     return response()->json([
        //         'msg' => 'data not available!'
        //     ]);
        // }
    }

    public function mpesaValidation()
    {
        $result_code = "0";
        $result_validation = "Accepted";
        return $this->createValidationResponse($result_code, $result_validation);
    }
    public function createValidationResponse($result_code, $result_validation)
    {
        $result = json_encode(['ResultCode' => $result_code, 'ResultDesc' => $result_validation]);
        $response = new Response();
        $response->headers->set("Content-Type", "application/json; charset-utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     * Process the callback data sent to this endpoint
     */
    public function lipaNaMpesaCallback(Request $requests)
    {
        $callBackdata = file_get_contents('php://input');
        $data = json_decode($callBackdata, true);
        if ($data["Body"]["stkCallback"]["ResultCode"] == 0) {
            $client = Client::where('phone', '0' . substr($data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"], -9, 12))->first();
            $data = [
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'phone' => $client->phone,
                'number_of_ticket' => $client->number_of_ticket,
                'name_of_ticket' => $client->name_of_ticket,
                'ticket_cost' => $client->ticket_cost,
            ];
            $this->generatePDF($data);
            $filePath = public_path($data['phone'] . '.pdf');
            if ($client->name_of_ticket == "Early Bird Ticket") {
                Mail::to($this->primary_email)
                    ->send(new sendMail($data, $filePath));
            }
            if ($client->name_of_ticket == "Regular Ticket") {
                Mail::to($this->primary_email)
                    ->send(new sendMail($client, $filePath));
            }
            if ($client->name_of_ticket == "Group Ticket") {
                Mail::to($this->primary_email)
                    ->send(new sendMail($client, $filePath));
            }
        }
    }
    public function generatePDF($data)
    {
        $pdf = PDF::loadView('mail.email', $data)->setPaper([0, 0, 300, 516], 'portrait');
        $pdf->render();
        file_put_contents($data['phone'] . '.pdf', $pdf->output());
    }

    public function stkPush()
    {
        // Format the phone number to Intl format
        $phone = sprintf('254%s', substr(request()->phone, 1, 9));
        // $price = (float)request()->ticket_price * (int)request()->number_of_tickets;
        // Generate an access token
        $accessToken = $this->generateAccesstoken();
        // Build the URL for the lnmo endpoint
        $url = sprintf('%s/mpesa/stkpush/v1/processrequest', $this->mpesa_stkpush_url);
        // Read the MPesa paybill config data
        $shortcode = env('MPESA_SHORT_CODE');
        // Get the current timestamp
        $timestamp = now()->format('YmdHis');
        // The password for encrypting the request.
        $passkey = $this->pass_key;
        //This is generated by base64 encoding BusinessShortcode, Passkey and Timestamp.
        $password = base64_encode(sprintf('%s%s%s', $shortcode, $passkey, $timestamp));
        //url callback to receive response
        $callbackUrl = $this->call_back_url . '/stk_callback_url';
        // Make the request
        $response = Http::withToken($accessToken)->post($url, [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'PartyA' => $phone,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => env('ACCOUNT_REF_NAME'),
            'TransactionDesc' => env('TRANSACTION_DESC')
        ])->json();
    }

    public function sendSms()
    {
        // Set your app credentials
        $username   = env('AFRICAISTALKING_USERNAME');
        $apiKey     = env('AFRICAISTALKING_API_KEY');

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms        = $AT->sms();

        // Set the numbers you want to send to in international format
        // $recipients = "+254711XXXYYY,+254733YYYZZZ";
        $recipients = +254715096287;

        // Set your message
        $message    = "sixx spirits testing";

        // Set your shortCode or senderId
        $from       = env('SMS_FROM');

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message,
                'from'    => $from
            ]);

            return response()->json([
                'msg' => $result
            ]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
