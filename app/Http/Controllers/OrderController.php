<?php
namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function details()
    {
        return $this->getOrderService()->details();
    }
    
    public function sendEmail(Order $order)
    {
        return $this->getOrderService()->sendEmail($order);
    }
}
