<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\PaymentProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WebshopController extends Controller
{
    //
    protected $mollie;

    function __construct(\Mollie\Api\MollieApiClient $mollie)
    {
        $mollie->setApiKey(config('mollie.MOLLIE_TEST_API_KEY'));
        $this->mollie = $mollie;
    }

    public function createPayment(OrderRequest $request)
    {
        //
        $order = new Order();
        $order->amount = $request->amount * 100;
        $order->save();

        Session::put('my-order', $order);

        $payment = $this->mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($order->amount / 100, 2, '.', '')
            ],
            "description" => "Webshop betaling",
            "redirectUrl" => route('payment.return'),
//            "webhookUrl"  => route('payment.webhook'),
            "webhookUrl"  => 'https://79ba-2a02-1811-c426-b400-a4a4-c450-82e-da64.eu.ngrok.io/payment/webhook',
            "metadata" => [
                "order_id" => $order->id
            ],
        ]);

        $order->payment_id = $payment->id;
        $order->save();

        return redirect($payment->getCheckoutUrl());
    }

    public function catchReturn(){

        $session_order = Session::get('my-order');
        Session::forget('my-order');

        $order = "";
        if($session_order){
            $order = Order::findOrFail($session_order->id);
        }

        return view('thank-you', compact('order'));
    }

    public function mollieWebhook(Request $request)
    {
        //
        $payment = $this->mollie->payments->get($request->id);

        Log::debug('Payment status for payment ID ' . $payment->id . ': ' . $payment->status);

        try {
            $provider = new PaymentProvider();
            $status = $provider->checkPaymentStatus($payment);

            //Conformation from app to Mollie the connection was successful
            return 'TRUE';

        } catch (\Mollie\Api\Exceptions\ApiException $e){
            Log::error("API call failed: " . htmlspecialchars($e->getMessage()));
        }
    }
}
