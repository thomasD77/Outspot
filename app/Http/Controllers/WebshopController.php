<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class WebshopController extends Controller
{
    //
    protected $mollie;

    function __construct(\Mollie\Api\MollieApiClient $mollie)
    {
        $api_key = config('mollie.MOLLIE_TEST_API_KEY');
        $mollie->setApiKey($api_key);
        $this->mollie = $mollie;
    }

    public function createPayment(OrderRequest $request)
    {
        //
        $order = new Order();
        $order->amount = $request->amount * 100;
        $order->save();

        $payment = $this->mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($order->amount / 100, 2, '.', '')
            ],
            "description" => "Webshop betaling",
            "redirectUrl" => route('payment.return'),
            "webhookUrl"  => route('payment.webhook'),
            "metadata" => [
                "order_id" => $order->id
            ],
        ]);

        $order->payment_id = $payment->id;
        $order->save();

        return redirect($payment->getCheckoutUrl());
    }

    public function mollieWebhook()
    {
        //
    }
}
