
<!DOCTYPE html>
<html>
 <head>
  <?php $title="Calender";
  include_once './Header.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'loaddate.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {<?php 
    if(isset($_SESSION['user'])){
        $U=$_SESSION['user'];
        if($U=='admin'){ ?> 
     var title = prompt("Enter Event Title");
     
     
     if(title )
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insertdate.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully"+title +" at "+ time);
       }
      })
    } <?php } }?>
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"updatedate.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"updatedate.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"deletedate.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
  <script>
     select: function(start, end, allDay) { 
   calendar.fullCalendar('unselect'); 
    var startDate = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
    var endDate = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
    $('#start').val(startDate);
    $('#end').val(endDate);
    $('#createEventModal').fadeIn(500);
    //Prevent default form action
    $('#createEventForm').on('submit', function(e){
        return false;
    });
    //Cancel Click close form
    $(document).on('click', '.close, .btnCancel', function(){   
      $('#createEventModal').hide('fast');
      document.getElementById("createEventForm").reset();
      calendar.fullCalendar('unselect');
    });
    //Submit event form click
    $('#submitButton').on('click', function(e){
      // We don't want this to act as a link so cancel the link action
      e.preventDefault();
      doSubmit();
    });
      function doSubmit(){
      var title = $('#createEventForm #title').val();
      if (title) {
       var data = $('#createEventForm').serialize();
       alert(data);
            $('#createEventModal').hide('fast');       
       $.ajax({
        url: wnm_custom.plugin_url+'/add_events.php',
       data: data,
       type: "POST",
         success: function(json) {
            document.getElementById("createEventForm").reset();
            $('div#myDialogSuccess').fadeIn(500);
            $('div#myDialogSuccess').fadeOut(2000);
         }
         });
         calendar.fullCalendar('renderEvent',
         {
         title: title,
         start: start,
         end: end,
         allDay: allDay
         },
         true // make the event "stick"
         );
         }
         calendar.fullCalendar('unselect');
         };
},
</script>
 </head>
 <body>
  <br />
  <h1 align="center">Calendar</h1>
  <br />
  <div class="container">
   <div id="calendar"></div>
   
   <!--div id='eventDialog' class='dialog ui-helper-hidden'>
			<form>
				<div>
					<label>Title:</label>
					<input id='title' class="field" type="text"></input>
				</div>
				<div>
					<label>Color:</label>
					<input id='color' class="field" type="text"></input>
				</div>
			</form>
		</div-->
  </div>
 </body>
 <?php include_once './Footer.php'; ?>
</html>