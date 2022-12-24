<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;

class PaymentProvider
{
    public function checkPaymentStatus($payment)
    {
        if(!$payment){
            Log::error("Er werd geen betaling gevonden met een order ID zoals uit Mollie." );
            return 'payment fail';
        }

        $order = Order::findOrFail($payment->metadata->order_id);

        if(!$order){
            Log::error("Er werd geen bestelling gevonden met een ID zoals uit Mollie." );
            return 'order fail';
        }

        Log::debug('Payment status for payment ID ' . $payment->id . ': ' . $payment->status);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            $order->payment_status = 'PAID';

            //Here you can send out mails to people in the company and clients
//                Mail::to('admin@outspot.be')->send(new OrderMail());

        } elseif ( $payment->isCanceled() ) {
            $order->payment_status = 'CANCELED';

        } else {
            $order->payment_status = 'PENDING';
        }

        $order->save();
    }
}
