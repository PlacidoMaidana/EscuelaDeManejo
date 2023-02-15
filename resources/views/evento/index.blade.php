<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        })
        calendar.render()
      })

    </script>
    


</head>
<body>
  
{{-- @section('content') --}}
<div class="container">
    <div id="calendar">
       
    </div> 
</div> 
{{-- @endsection' --}}
<script src="{{ asset('js/agenda.js') }}" defer></script>
</body>
</html>