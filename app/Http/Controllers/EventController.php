<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy("created_at", "desc")->paginate(10);
        return view("events/index", compact("events"));
    }

    public function createEvent()
    {
        $reminderId = $this->generateReminderId();
        return view("events/addEvent", compact("reminderId"));
    }

    public function eventStore(StoreEventRequest $request)
    {
        try {
            // Process the emails
            $notifyEmails = $this->processEmails($request->notify_emails);

            // Create the event using mass assignment
            Event::create([
                'event_title' => $request->event_title,
                'event_description' => $request->event_description,
                'event_date' => $request->event_date,
                'reminder_id' => $request->reminder_id,
                'is_completed' => $request->is_completed == 'on' ? 1 : 0,
                'notify_emails' => $notifyEmails,
            ]);

            return redirect()->route('index')->with('success', 'Data has been added successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Event creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while adding the data. Please try again.');
        }
    }

    public function eventUpdate(StoreEventRequest $request, $id)
    {
        try {
            $event = Event::findOrFail($id);

            // Process the emails
            $notifyEmails = $this->processEmails($request->notify_emails);

            // Update the event using mass assignment
            $event->update([
                'event_title' => $request->event_title,
                'event_description' => $request->event_description,
                'event_date' => $request->event_date,
                'reminder_id' => $request->reminder_id,
                'is_completed' => $request->is_completed == 'on' ? 1 : 0,
                'notify_emails' => $notifyEmails,
            ]);

            return redirect()->route('index')->with('success', 'Data has been updated successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Event update failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while updating the data. Please try again.');
        }
    }

    public function eventEdit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events/editEvent', compact('event'));
    }

    public function eventDelete(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->route('index')->with('success', 'Event has been deleted successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Event deletion failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while deleting the event. Please try again.');
        }
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'import_csv' => 'required|mimes:csv',
        ]);

        try {
            // Read csv file and skip data
            $file = $request->file('import_csv');
            $handle = fopen($file->path(), 'r');

            // Skip the header row
            fgetcsv($handle);

            $chunksize = 25;
            while (!feof($handle)) {
                $chunkdata = [];
                for ($i = 0; $i < $chunksize; $i++) {
                    $data = fgetcsv($handle);
                    if ($data === false) {
                        break;
                    }
                    $chunkdata[] = $data;
                }
                $this->getchunkdata($chunkdata);
            }
            fclose($handle);

            return redirect()->route('index')->with('success', 'Data has been added successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('CSV import failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while importing the data. Please try again.');
        }
    }

    public function getchunkdata($chunkdata)
    {
        foreach ($chunkdata as $column) {
            $event_title = $column[0];
            $event_description = $column[1];
            $event_date = $column[2];
            $reminder_id = $column[3];
            $notify_emails = $column[4];
            $is_completed = $column[5];

            // Create new Event
            Event::create([
                'event_title' => $event_title,
                'event_description' => $event_description,
                'event_date' => $event_date,
                'reminder_id' => $reminder_id,
                'notify_emails' => $this->processEmails($notify_emails),
                'is_completed' => $is_completed,
            ]);
        }
    }

    private function processEmails($emails)
    {
        if (empty($emails)) {
            return [];
        }

        return array_map('trim', explode(',', $emails));
    }

    public static function generateReminderId()
    {
        return 'EVT-' . strtoupper(uniqid());
    }
}
