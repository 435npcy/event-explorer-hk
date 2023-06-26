<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $orders = Order::where('user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request, string $eventId): RedirectResponse
    {
        $validated = $request->validated();

        $items = $request->input('items');
        $user = $request->user();
        $event = Event::findOrFail($eventId);


        foreach ($items as $ticketTypeId => $quantity) {
            if ($quantity === '0') {
                return back()->withErrors(['message' => 'Quantity cannot be zero.']);
            }
        }



        $order = new Order([
            'status' => Order::DRAFT,
        ]);
        $order->user()->associate($user);
        $order->event()->associate($event);
        $order->save();

        foreach ($items as $ticketTypeId => $quantity) {
            if ($quantity > 0) {
                $ticketType = TicketType::findOrFail($ticketTypeId);
                $orderItem = new OrderItem([
                    'sub_price' => $ticketType->price,
                    'quantity' => $quantity,
                    'sub_amount' => $ticketType->price * $quantity,
                ]);
                $orderItem->order()->associate($order);
                $orderItem->ticketType()->associate($ticketType);
                $orderItem->save();
            }
        }

        $order->total_amount = $order->calculateTotalAmount();
        $order->save();

        return redirect(route('payment.charge', [
            'orderId' => $order->id,
        ]));
    }
}