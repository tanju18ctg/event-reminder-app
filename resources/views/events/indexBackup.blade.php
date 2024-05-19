@extends('layouts/event_layouts')

@section('events')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-4 offset-md-8">
            <div>
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="messages">
                        @if (session('success'))
                        <div class="alert alert-success" id="flash-message">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="fields">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                            <label class="input-group-text" for="import_csv">Upload</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Import CSV</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <a href="{{route('add-event')}}" class="btn btn-success">Add New Event</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:10%">Reminder ID</th>
                        <th style="width:20%">Title</th>
                        <th style="width:20%">Description</th>
                        <th style="width:15%">Event Date</th>
                        <th style="width:15%">Notified Email</th>
                        <th style="width:10%">Status</th>
                        <th style="width:15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($events) > 0 )
                    @foreach ($events as $event)
                    <tr>
                        <td style="width:10%">{{$event->reminder_id}}</td>
                        <td style="width:20%">{{$event->event_title}}</td>
                        <td style="width:20%">{{$event->event_description}}</td>
                        <td style="width:15%">{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}</td>
                        <td style="width:15%">{{implode(", ", $event->notify_emails)}}</td>
                        <td style="width:10%">{{$event->event_date ? 'Completed' : 'Pending'}}</td>
                        <td style="width:15%">
                            <a class="btn btn-primary btn-sm" style="float: left;" href="{{url('eventEdit/'.$event->id)}}"> <i class="fa fa-pencil"></i> </a>
                            <!-- <a href="#">View</a> -->
                            <a class="btn btn-danger btn-sm" href="{{url('eventDelete/'.$event->id)}}"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="7" style="color:brown; font-size:18px; text-align:center; font-weight:bold;">No Event Found !</td>
                    </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>  
    // resources/js/app.js or your main JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 2000); // 2 seconds
    }
});

</script>
@endsection