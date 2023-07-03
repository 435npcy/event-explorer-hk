<?php

namespace App\Http\Controllers;

use chillerlan\QRCode\QRCode;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class TicketController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request): View
  {
    $user = $request->user();
    $tickets = Ticket::where('user_id', '=', $user->id)
      ->orderBy('created_at', 'desc')
      ->get();

    $ticketsWithQrCode = [];
    foreach ($tickets as $ticket) {
        $temp = $ticket;
        $temp['qrcode'] = (new QRCode)->render($ticket->id);
        $ticketsWithQrCode[] = $temp;
    }

    return view('tickets.index', [
      'tickets' => $ticketsWithQrCode,
    ]);
  }
}