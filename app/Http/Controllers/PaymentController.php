<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

class PaymentController extends Controller
{
  public function charge(string $orderId)
  {
    $order = Order::findOrFail($orderId);

    $user = Auth::user();
    $paymentIntent = $user->createSetupIntent();
    Log::info(['paymentIntent', $paymentIntent]);

    $order->status = Order::PREPARED;
    $order->save();

    return view('payment', [
      'user' => $user,
      'intent' => $paymentIntent,
      'order' => $order,
    ]);
  }

  public function process(Request $request, string $orderId)
  {
    $order = Order::findOrFail($orderId);
    $user = Auth::user();

    if ($order->total_amount > 0) {
      $paymentMethod = $request->input('payment_method');
      $user->createOrGetStripeCustomer();
      $user->addPaymentMethod($paymentMethod);
      Log::info(['$user', $user]);

      $order->status = Order::PROCESSING;
      $order->stripe_payment_method = $paymentMethod;
      $order->save();
      try {
        $user->charge($order->total_amount * 100, $paymentMethod);
      } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Error creating payment. ' . $e->getMessage()]);
      }
    } else {
      $order->status = Order::SUCCEEDED;
      $order->save();

      foreach ($order->items as $item) {
        for ($i=0; $i < $item->quantity; $i++) { 
          $ticket = new Ticket();
          $ticket->event()->associate($order->event->id);
          $ticket->user()->associate($user);
          $ticket->ticketType()->associate($item->ticketType);
          $ticket->order()->associate($order);
          $ticket->save();
        }
      }
    }

    return redirect(route('payment.result', [$order->id]));
  }

  public function webhooks(Request $request)
  {
    Log::info($request->all());
    $type = $request->input('type');
    if ($type === 'payment_intent.succeeded') {
      $data = $request->input('data');
      $paymentMethod = $data['object']['payment_method'];
      $order = Order::where('stripe_payment_method', '=', $paymentMethod)->get()->first();
      $order->status = Order::SUCCEEDED;
      $order->save();

      foreach ($order->items as $item) {
        for ($i=0; $i < $item->quantity; $i++) { 
          $ticket = new Ticket();
          $ticket->event()->associate($order->event->id);
          $ticket->user()->associate($order->user);
          $ticket->ticketType()->associate($item->ticketType);
          $ticket->order()->associate($order);
          $ticket->save();
        }
      }

      // send email
      // Mail::send();
    }

    return response()->json([], 200);
  }

  public function getResult(Request $request, string $orderId)
  {
    $order = Order::findOrFail($orderId);
    // $user = Auth::user();

    return view('payment.result', [
      'order' => $order,
      'event' => $order->event,
    ]);
  }
}