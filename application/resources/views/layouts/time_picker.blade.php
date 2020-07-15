<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $('input.timepicker').timepicker({});
});
    $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '8',
    maxTime: '6:00pm',
    defaultTime: '',
    startTime: '8:00',
    dynamic: true,
    dropdown: true,
    scrollbar: false
});


</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>