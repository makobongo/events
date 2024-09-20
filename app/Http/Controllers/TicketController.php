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
use App\Mail\sendEarlyTicket;
use App\Mail\sendGroupTicket;
use App\Mail\sendPaymentNotification;
use App\Mail\sendRegularTicket;

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
        $phone = sprintf('254%s', substr(request()->phone, 1, 9));
        if (Client::where('phone', $phone)->exists()) {
            $ticket = explode(',', request()->ticket);
            $name_of_ticket = $ticket[1];
            $cost_of_a_ticket = (int) $ticket[0];
            $number_of_tickets = request()->number_of_tickets;
            $ticket_cost = $cost_of_a_ticket * $number_of_tickets;
            Client::where('phone', $phone)->update([
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
                'phone' => $phone,
                'sha_phone' => hash('sha256', $phone),
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
        if (!is_null($data)) {
            try {
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
                    'ticket_number' => env('ACCOUNT_INIT') . '-' . $data['TransID'],
                    'ticket_is_valid' => true
                ]);
                // matching records
                $client = Payment::join('clients', 'payments.MSISDN', '=', 'clients.sha_phone')
                    ->select('clients.*', 'payments.TransAmount')
                    ->orderBy('payments.created_at', 'DESC')->first();
                //Sending SMS to clients
                $this->sendSms($client->phone, $client->first_name, $client->TransAmount);
                $data = [
                    'first_name' => $client->first_name,
                    'last_name' => $client->second_name,
                    'phone' => $client->phone,
                    'number_of_ticket' => $client->number_of_ticket,
                    'name_of_ticket' => $client->name_of_ticket,
                    'ticket_cost' => $client->ticket_cost,
                ];
                if ($client->name_of_ticket == "Advance Early Bird Ticket") {
                    $this->generatePDF($data, $client->phone, 'mail.tickets.early');
                    $fileName = $client->phone . '.pdf';
                    Mail::to($this->primary_email)
                        ->cc($client->email)
                        ->send(new sendEarlyTicket($client, $fileName));
                }
                if ($client->name_of_ticket == "Advance Regular Ticket") {
                    $this->generatePDF($data, $client->phone, 'mail.tickets.regular');
                    $fileName = $client->phone . '.pdf';
                    Mail::to($this->primary_email)
                        ->cc($client->email)
                        ->send(new sendRegularTicket($client, $fileName));
                }
                if ($client->name_of_ticket == "Advance Group Ticket") {
                    $this->generatePDF($data, $client->phone, 'mail.tickets.group');
                    $fileName = $client->phone . '.pdf';
                    Mail::to($this->primary_email)
                        ->cc($client->email)
                        ->send(new sendGroupTicket($client, $fileName));
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return response()->json([
                'msg' => 'No data available'
            ]);
        }
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
    // public function lipaNaMpesaCallback(Request $requests)
    // {
    //     $callBackdata = file_get_contents('php://input');
    //     $data = json_decode($callBackdata, true);
    //     if ($data["Body"]["stkCallback"]["ResultCode"] == 0) {
    //         $client = Client::where('phone', '0' . substr($data["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"], -9, 12))->first();
    //         $data = [
    //             'first_name' => $client->first_name,
    //             'last_name' => $client->last_name,
    //             'phone' => $client->phone,
    //             'number_of_ticket' => $client->number_of_ticket,
    //             'name_of_ticket' => $client->name_of_ticket,
    //             'ticket_cost' => $client->ticket_cost,
    //         ];
    //         $this->generatePDF($data);
    //         $filePath = public_path($data['phone'] . '.pdf');
    //         if ($client->name_of_ticket == "Early Bird Ticket") {
    //             Mail::to($this->primary_email)
    //                 ->send(new sendMail($data, $filePath));
    //         }
    //         if ($client->name_of_ticket == "Regular Ticket") {
    //             Mail::to($this->primary_email)
    //                 ->send(new sendMail($client, $filePath));
    //         }
    //         if ($client->name_of_ticket == "Group Ticket") {
    //             Mail::to($this->primary_email)
    //                 ->send(new sendMail($client, $filePath));
    //         }
    //     }
    // }
    public function generatePDF($data, $phone, $view)
    {
        $pdf = PDF::loadView($view, $data)->setPaper([0, 0, 300, 513], 'portrait');
        $pdf->render();
        Storage::disk('local')->put($phone . '.pdf', $pdf->output());
        // file_put_contents($phone.'.pdf', $pdf->output());
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

    public function sendSms($phone, $firstname, $amount)
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
        $recipients = $phone;

        // Set your message
        $message = "Hello, " . $firstname . " We confirm receipt of Ksh " . $amount . " which has been paid to " . env("APP_NAME") . " .For any queries call " . env("CONTACT_NUMBER") . "  Regards ";

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
