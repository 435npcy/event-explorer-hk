<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::where('start_at', '>', Carbon::now())
            ->orderBy('start_at')
            ->get();

        return view('events.index', [
            'events' => $events,
        ]);
    }

    /**
     * Handle event search querey.
     */
    public function search(Request $request): RedirectResponse
    {
        return redirect(
            route(
                'events.search',
                ['keyword' => $request->input('searchKeyword')]
            )
        );
    }

    /**
     * Display a listing of the event search result.
     */
    public function listSearchResult(string $keyword = ''): View
    {
        $events = [];

        if ($keyword) {
            $result = DB::table('events')
            ->whereFullText('title', $keyword)
            ->orWhereFullText('description', $keyword)
        
            ->orWhereFullText('venue', $keyword)
            ->get();

            $events = $result->map(function ($event) {
                $newevent = Event::findOrFail($event->id);
                return $newevent;
            });
        }

        return view('events.search-result', [
            'events' => $events,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function listTodayEvents(): View
    {
        $now = Carbon::now();
        $events = Event::where([
            ['start_at', '>=', $now->copy()->startOfDay()],
            ['start_at', '<=', $now->copy()->endOfDay()]
        ])
            ->orderBy('start_at')
            ->get();

        return view('events.list-today', [
            'events' => $events,
        ]);
    }

    public function listActiveEventsByCategory(string $categoryName): View
    {
        $catgory = Category::where('name', $categoryName)->get()->first();

        $events = Event::where('category_id', '=', $catgory->id)
            ->orderBy('start_at')
            ->get();

        return view('events.list-by-category', [
            'category' => $catgory,
            'events' => $events,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $event = Event::findOrFail($id);

        return view('events.show', [
            'event' => $event
        ]);
    }
}