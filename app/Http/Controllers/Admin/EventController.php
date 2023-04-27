<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::all()->sortByDesc('created_at');

        return view('admin.events.index', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventUpdateRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        $event = Event::create($validated);

        return redirect(route('admin.events.show', [
            'event' => $event
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.show', [
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();

        $event->update($validated);

        return redirect(route('admin.events.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect(route('admin.events.index'));
    }
}