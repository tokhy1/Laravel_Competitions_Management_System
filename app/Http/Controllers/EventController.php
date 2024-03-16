<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEvents()
    {
        try {
            $events = Event::get();
            return view('admin_dashboard.events', ['events' => $events]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addEvent(Request $request)
    {
        try {
            Event::insert([
                'event_name' => $request->event_name,
                'event_type' => $request->event_type,
                'event_points' => $request->event_points,
                'competition_id' => $request->competition_id
            ]);

            return redirect('/dashboard/events');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteEvent($id)
    {
        try {
            Event::findOrFail($id)->delete();
            return redirect('/dashboard/event');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateEvent(Request $request, $id)
    {
        try {
            Event::findOrFail($id)->update([
                'event_name' => $request->event_name,
                'event_type' => $request->event_type,
                'event_points' => $request->event_points,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
            ]);

            return redirect('/dashboard/events');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

}
