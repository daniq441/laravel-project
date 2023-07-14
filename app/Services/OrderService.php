<?php
namespace App\Services;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderService{
    public function details()
    {
        $orders = Order::all();
        return view('orders.dashboard', compact('orders'));
    }
    
    public function sendEmail($order)
    {
        try {
            // Send email logic
            Mail::to($order->orderEmail)->send(new OrderConfirmation($order));
    
            // Email sent successfully
            return redirect()->back()->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            // Email sending failed
            return redirect()->back()->with('error', 'Failed to send email.');
        }
    }
}