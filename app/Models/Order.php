<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'orderuser_id',
        'orderAmount',
        'orderShipName',
        'orderShipAddress',
        'orderCity',
        'orderState',
        'orderZip',
        'orderCountry',
        'orderPhone',
        'orderEmail',
        'orderStatus',
        'orderTrackingNumber',
    ];
}
