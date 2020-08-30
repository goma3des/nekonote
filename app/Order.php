<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $guarded = array('id');

  public static $rules = array(
    'title' => 'required',
    'content' => 'required',
    'deadline' => 'required',
    'required_skill' => 'required',
    'status' => 'nullable',
    'client_eval_point' => 'nullable',
    'client_assessment' => 'nullable',
    'enabler_eval_point' => 'nullable',
    'enabler_assessment' => 'nullable',
    'client_id' => 'nullable',
    'enabler_id' => 'nullable',
    'point' => 'nullable',
  );

  public static $client_evaluation_rules = array(
    'client_eval_point' => 'required',
    'client_assessment' => 'required',
  );

  public static $enabler_evaluation_rules = array(
    'enabler_eval_point' => 'required',
    'enabler_assessment' => 'required',
  );

  public function client()
  {
    return User::find($this->client_id);
  }

  public function enabler()
  {
    return User::find($this->enabler_id);
  }

  public function messages()
  {
    return $this->hasMany('App\Message');
  }

}
