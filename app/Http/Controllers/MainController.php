<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Order;

class MainController extends Controller
{
    public function index()
    {
      $orders = Order::all()->sortByDesc('created_at');
//      $order->client_id = $request->user()->id;


    return view('index', ['orders' => $orders]);
    }
}
