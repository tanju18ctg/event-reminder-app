@extends('layouts/event_layouts')

@section('events')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="#"> Add Events</a>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{route('event-update', $event->id)}}">
            @csrf
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Reminder ID</label>
                    <input type="text" name="reminder_id" class="form-control" id="inputPassword4" value="{{$event->reminder_id}}">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Event Title</label>
                    <input type="text" name="event_title" class="form-control" id="inputEmail4" value="{{$event->event_title}}">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Description</label>
                    <input type="text" name="event_description" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{$event->event_description}}">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Event Date</label> 
                    <input type="date" name="event_date" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}">
                </div>
                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Notify Email (Comma Separated)</label> 
                    <input type="text" name="notify_emails" class="form-control" id="inputCity" value="{{implode(", ", $event->notify_emails)}}">
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" name="is_completed" type="checkbox" id="gridCheck"  {{$event->is_completed ? 'checked' : ''}}>
                        <label class="form-check-label" for="gridCheck">
                           Is Complete?
                        </label>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection