<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;


class PaymentController extends Controller
{
  public function charge(string $product, $price)
  {
    $user = Auth::user();

    $paymentIntent = $user->createSetupIntent();

    Log::info($paymentIntent);
    return view('payment', [
      'user' => $user,
      'intent' => $paymentIntent,
      'product' => $product,
      'price' => $price,
    ]);
  }

  public function processPayment(Request $request, string $product, $price)
  {
    $user = Auth::user();
    $paymentMethod = $request->input('payment_method');
    $user->createOrGetStripeCustomer();
    $user->addPaymentMethod($paymentMethod);
    Log::info($user);
    try {
      $user->charge($price * 100, $paymentMethod);
    } catch (\Exception $e) {
      return back()->withErrors(['message' => 'Error creating payment. ' . $e->getMessage()]);
    }

    return redirect('/payment/result');
  }

  public function webhooks(Request $request)
  {
    Log::info($request->all());
    return response()->json([], 200);
  }

  public function getResult()
  {
    return view('payment.result');
  }
}