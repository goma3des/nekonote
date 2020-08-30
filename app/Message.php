<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'inquiry' => 'required',
    'user_id' => 'required',
    'order_id' => 'required',

  );

  public function orderid()
  {
    return $this->belongsTo('App\Order');
    }

  public function userid()
  {
    // return $this->belongsTo('App\User');
    return User::find($this->user_id);
    }


}
