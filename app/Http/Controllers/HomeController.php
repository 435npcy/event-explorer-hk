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
    $now = Carbon::now();
    $thisWeekEvents = Event::where([
        ['start_at', '<=', $now->copy()->endOfDay()],
        ['end_at', '>=', $now->copy()->addDays(7)->startOfDay()]
    ])
      ->get()->random(4)->shuffle();

    $upcomingEvents = Event::where('start_at', '>', now())
      ->orderBy('start_at')
      ->limit(4)
      ->get();
    
    $pickedEvents = Event::all()->random(4)->shuffle();

    return view('home', [
      'thisWeekEvents' => $thisWeekEvents,
      'upcomingEvents' => $upcomingEvents,
      'pickedEvents' => $pickedEvents,
    ]);
  }
}