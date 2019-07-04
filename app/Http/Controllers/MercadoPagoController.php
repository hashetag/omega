<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use MP;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;

class MercadoPagoController extends Controller
{
  public function getManmanw(Request $request)
  {
    return view('frontend.checkout');
  } 
  
  public function getCheckout(Request $request)
  {
    $data       = $request->all(); //request all from form 
    $session_id = Session::getId();
    $user_id    = Session::getUserId();


    $user = DB::table('users')->where('user_id', $user_id)->first();
    $user_email = $user->email;

    $ticket     = rand(11) ; 
    DB::table('orders_request')->insert([
      'ticket'         => $ticket,
      'user_id'        => $user_id,
      'user_email'     => $user_email,
      'empresa_id'     => 4,//$data['empresa_id'],
      'subtotal'       => 240,//$data['subtotal'],
      'shipping'       => 100,//$data['shipping'],
      'total'          => 250,//$data['total'],
      'payment_status' => $data['payment_status'],
      'aproved'        => $data['aproved']

    ]);
    
    $orderReady = DB::table('orders_request')->where('user_id', $user_id)->where('empresa_id', $data['empresa_id'])->where('ticket', $ticket)->first();

    Session::flash('message' , 'listo para finalizar la compra!');
    //echo "<pre>"; print_r($slug); die;
    return  view('frontend.checkout')->with(['orderReady' => $orderReady]);
  }

  public function createPayment()
  {
   /* $payment_data = array(
      "transaction_amount" => '1000',
      "description" => 'Juego de Cocina',
      "installments" => '1',
      "payment_method_id" => '1',
      "payer" => array(
                    "email" => 'test@test.com'
       ),
       "statement_descriptor" => "testor"
    );
    $payment = MP::post("/v1/payments",$payment_data);
    dd($payment); die;*/
    //return dd($payment);
    //return view('frontend.checkout')->with(['payment' => $payment]);
  }
}
