@extends('layouts/event_layouts')

@section('events')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="#"> Add Events</a>
        </div>
        <div class="card-body">
            <form class="row g-3" method="post" action="{{route('event-store')}}">
            @csrf
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Reminder ID</label>
                    <input type="text" name="reminder_id" class="form-control" id="inputPassword4" value="{{$reminderId}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Event Title</label>
                    <input type="text" name="event_title" class="form-control" id="inputEmail4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Description</label>
                    <input type="text" name="event_description" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Event Date</label>
                    <input type="date" name="event_date" value="<?php echo date("Y-m-d")?>" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Notify Email (Comma Separated)</label>
                    <input type="text" name="notify_emails" class="form-control" id="inputCity">
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" name="is_completed" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                           Is Complete?
                        </label>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('index')}}"  class="btn btn-success">Back To Home</a>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Add Event</button>
                        </div>
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-danger">Reset Event</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection