<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\UserService;
use App\Services\ProductService;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getUserService(){
       return new UserService();
    }

    public function getProductService(){
        return new ProductService();
     }
    
     public function getOrderService(){
      return new OrderService();
   }
}
