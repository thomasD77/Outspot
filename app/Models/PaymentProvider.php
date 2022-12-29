<?php

namespace App\Models;

use App\Enums\OrderState;
use Illuminate\Support\Facades\Log;

class PaymentProvider
{
    public function checkPaymentStatus($payment)
    {
        if(!$payment){
            Log::error("There was no payment found in Mollie" );
            return 'payment fail';
        }

        $order = Order::findOrFail($payment->metadata->order_id);

        if(!$order){
            Log::error("There was no order found" );
            return 'order fail';
        }

        Log::debug('Payment status for payment ID ' . $payment->id . ': ' . $payment->status);

        if ($payment->isPaid()) {
            $order->payment_status = OrderState::Paid->value;

            //Here you can send out mails to people in the company and clients
//                Mail::to('admin@outspot.be')->send(new OrderMail());

        } elseif ( $payment->isCanceled() ) {
            $order->payment_status = OrderState::Canceled->value;

        } else {
            $order->payment_status = OrderState::Pending->value;
        }

        $order->update();
    }
}
