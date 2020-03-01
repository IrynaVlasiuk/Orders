<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrdersTableNotification;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->testRecipient = [
            'address'     => env('MAIL_TEST_RECIPIENT_EMAIL', 'test@test.com'),
            'name' => env('MAIL_TEST_RECIPIENT_NAME', 'John Doe'),
        ];

        $this->testMode = env('MAIL_TEST_MODE');

        $this->emailCC1 = [
            'address'     => env('MAIL_CC1'),
            'name' => 'CC1',
        ];

        $this->emailCC2 = [
            'address'     => env('MAIL_CC2'),
            'name' => 'CC2',
        ];
    }

    public function sendOrdersTable()
    {
        $orders = Order::whereHas('products')->get();

        if($this->testMode) {
            Mail::to($this->testRecipient['address'])
                ->send(new OrdersTableNotification('OrdersTest', 'layouts.emails.orders.ordersTable', $orders));
        } else {
            Mail::to($this->emailCC1['address'])
                ->cc($this->emailCC2['address'])
                ->send(new OrdersTableNotification('Orders', 'layouts.emails.orders.ordersTable', $orders));
        }

        return redirect()->route('order.index');
    }
}
