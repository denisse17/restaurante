<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Pedido;
use App\PedidoItem;

class PaypalController extends Controller
{  
    private $_api_context;   
 
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential('CLIENT_ID', 'SECRET'));
		$this->_api_context->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 300,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
			)
		);
	}
 
	public function postPago()
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 
		$items = array();
		$subtotal = 0;
		$cart = \Session::get('cesta');
		$currency = 'USD';
 
		foreach($cart as $producto){
			$item = new Item();
			$item->setName($producto->nombre)
			->setCurrency($currency)
			->setDescription($producto->nombre)
			->setQuantity($producto->cantidad)
			->setPrice($producto->precio);
 
			$items[] = $item;
			$subtotal += $producto->cantidad * $producto->precio;
		}
 
		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping(10);
 
		$total = $subtotal + 10;
 
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App Store');
 
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('pago.status'))
			->setCancelUrl(\URL::route('pago.status'));
 
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
 
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
 
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart')
			->with('message', 'Ups! Error desconocido.');
 
	}
 
	public function getPagoStatus()
	{
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');
 
		// clear the session payment ID
		\Session::forget('paypal_payment_id');
 
		$payerId = Input::get('PayerID');
		$token = Input::get('token');
 
		if (empty($payerId) || empty($token)) {
			return \Redirect::route('home')
				->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}
 
		$payment = Payment::get($payment_id, $this->_api_context);
 
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
 
		$result = $payment->execute($execution, $this->_api_context);
 
 
		if ($result->getState() == 'approved') {
 
			$this->saveOrder();
 
			\Session::forget('cesta');
 
			return \Redirect::route('home')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('home')
			->with('message', 'La compra fue cancelada');
	}
 
	protected function saveOrder()
	{
		$subtotal = 0;
		$cart = \Session::get('cesta');
		$shipping = 10;
 
		foreach($cart as $producto){
			$subtotal += $producto->cantidad * $producto->precio;
		}
 
		$pedido = Pedido::create([
			'subtotal' => $subtotal,
			'shipping' => $shipping,
			'user_id' => \Auth::user()->id
		]);
 
		foreach($cart as $producto){
			$this->saveOrderItem($producto, $pedido->id);
		}
	}
 
	protected function saveOrderItem($producto, $pedido_id)
	{
		PedidoItem::create([
			'precio' => $producto->precio,
			'cantidad' => $producto->cantidad,
			'producto_id' => $producto->id,
			'pedido_id' => $pedido_id
		]);
	}
}
