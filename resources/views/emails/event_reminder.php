<!DOCTYPE html>
<html>
<head>
    <title>Event Reminder</title>
</head>
<body>
    <h1>{{ $event->event_title }}</h1>
    <p>{{ $event->event_description }}</p>
    <p>Date: {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}</p>
</body>
</html>
