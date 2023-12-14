<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


use YooKassa\Client;

class PaymentController extends Controller
{
    public function getPaymentLink(Request $request)
    {

        $data = $request->validate([
            "price" => ["numeric", "required"],
            "order_id" => ["numeric", "required"],
        ]);

        $client = $this->getClient();


        $payment = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $data['price'],
                    'currency' => 'RUB',
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => env('APP_URL') . "/order-success/" . $data['order_id'],
                ),
                'metadata' => array(
                    'order_id' => $data['order_id'],

                ),
                'capture' => true,
                'description' => 'Заказ №' . $data['order_id'],
            ),
            uniqid('', true),
        );


        return $payment->getConfirmation()->getConfirmationUrl();
    }

    public function callbackPay(Request $request)
    {
        $data =  $request->all();
        $responseObj = $data['object'];
        $orderId = $responseObj['metadata']['order_id'];
        $status = $responseObj['status'];
        if ($status === 'succeeded') {
            Order::where('id', $orderId)->update(['status' => 'Заказ оплачен']);
        }
    }


    protected function getClient()
    {
        $client = new Client();
        $client->setAuth(
            289195,
            'test_klg41nqVAQkuRQGXopfYzEBQOAPeUGED1evOpg8noeM'
        );
        return $client;
    }
}