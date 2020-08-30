<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;
use App\Message;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except('index');
  }


  public function add()
  {
    return view('admin.order.create');
  }


  public function create(Request $request)
  {
    $this->validate($request, Order::$rules);

    $order = new Order;
    $order->client_id = $request->user()->id;
    $order->status = '0';
    $form = $request->all();

    unset($form['_token']);

    $order->fill($form);
    $order->save();

    return redirect('/');
  }



  public function edit(Request $request)
  {
    $order = Order::find($request->id);

    return view('admin.order.edit', ['order' => $order]);
  }


  public function update(Request $request)
  {
    $this->validate($request, Order::$rules);
    $order = Order::find($request->id);
    $order_form = $request->all();
    unset($order_form['_token']);

    $order->fill($order_form)->save();

    return redirect()->action('Admin\OrderController@show', ['id' => $request->id]);
  }

  public function show(Request $request)
  {
    $order = Order::find($request->id);
    if (empty($order)) {
      abort(404);
    }
    $messages = Message::all()->sortByDesc('updated_at');

    return view('admin.order.show', ['order' => $order], ['messages' => $messages]);
  }


  public function inquire(Request $request)
  {
    $message = new Message;
    if (empty($request->inquiry)) {
      return view('admin.order.show', ['message' => $message]);
    } else {
      $message->user_id = Auth::user()->id;
      $message->order_id = $request->id;
      $message->inquiry = $request->inquiry;
      $message->save();
    }
    return redirect()->action('Admin\OrderController@show', ['id' => $request->id]);
  }


  public function deleteinquiry(Request $request)
  {
    $message = Message::find($request->id);
    $message->delete();

    return back();
  }


  public function accept(Request $request)
  {
    $order = Order::find($request->id);
    $order->status = '1';
    $order->enabler_id = $request->user()->id;
    $order->save();

    return view('admin.order.accept', ['order' => $order]);
  }


  public function delete(Request $request)
  {
    $order = Order::find($request->id);
    $order->delete();
    return redirect('/');
  }

  public function add_evaluate_client(Request $request)
  {
      $order = Order::find($request->id);

    return view('admin.order.evaluate_client', ['order' => $order]);
  }


  public function evaluate_client(Request $request)
  {
    $this->validate($request, Order::$client_evaluation_rules);
    $order = Order::find($request->id);
    $order->client_eval_point = $request->client_eval_point;
    $order->client_assessment = $request->client_assessment;

    $order->save();

    return redirect('/');
  }

  public function add_evaluate_enabler(Request $request)
  {
      $order = Order::find($request->id);

    return view('admin.order.evaluate_enabler', ['order' => $order]);
  }


  public function evaluate_enabler(Request $request)
  {
    $this->validate($request, Order::$enabler_evaluation_rules);
    $order = Order::find($request->id);
    $order->enabler_eval_point = $request->enabler_eval_point;
    $order->enabler_assessment = $request->enabler_assessment;
    $order->status = $request->status;
    $order->save();

    return redirect('/');
  }


}
