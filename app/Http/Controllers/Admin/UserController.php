<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Order;
use Carbon\Carbon;
use Storage;

class UserController extends Controller
{




/*    public function add()
    {
      return view('admin.user.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, User::$rules);

      $user = new User;
      $form = $request->all();

      unset($form['_token']);

      $user->fill($form);
      $user->save();

      return redirect('admin/user/show', ['user' => $user]);
    }
*/

    public function edit(Request $request)
    {
      $user = User::find($request->id);
      $user->point = "0";
      return view('admin.user.edit', ['user' => $user ]);
    }


    public function update(Request $request)
    {
      $this->validate($request, User::$rules);
      $user = User::find($request->id);
      $user_form = $request->all();
//      $user->password = Hash::make($request->password);
      if (isset($user_form['image'])) {
//        if($request->file('image')->isValid()){
//          $path = $request->file('image')->store('public/image');  テスト環境下のコード
//          $user->image_path = basename($path);
          $path = Storage::disk('s3')->putFile('/',$user_form['image'],'public');
          $user->image_path = Storage::disk('s3')->url($path);
          unset($user_form['image']);
        // }
      } elseif (0 == strcmp($request->remove, 'true')) {
        $user->image_path = null;
      }

      unset($user_form['_token']);
      unset($user_form['password']);

      $user->fill($user_form)->save();

      return redirect()->action('Admin\UserController@show', ['id' => $request->id]);
    }


    public function show(Request $request)
    {
      $user = User::find($request->id);
      $orders = Order::where('client_id', $user->id)->get();
      $order_name = array();
      foreach ($orders as $order) {
//        $array = $order->enabler();
        // var_dump($array['name']);
        $order_name[] = $order->enabler();
      }
      $accepts = Order::where('enabler_id', $user->id)->get();
      $accept_name = array();
      foreach ($accepts as $accept) {
        $accept_name[] = $accept->client();
      }
      $user->point = $user->point + Order::where('client_id', $user->id)->sum('client_eval_point') + Order::where('enabler_id', $user->id)->sum('enabler_eval_point');
      return view('admin.user.show', ['user' => $user, 'orders' => $orders, 'accepts' => $accepts, 'order_name' => $order_name, 'accept_name' => $accept_name]);
    }


    public function delete(Request $request)
    {
      $user = User::find($request->id);
      $user->delete();
      return redirect('/');
    }

}
