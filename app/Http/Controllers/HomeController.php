<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $events = Event::where('start_at', '>', now())
      ->orderBy('start_at')
      ->get();

    return view('home', [
      'events' => $events,
    ]);
  }
}