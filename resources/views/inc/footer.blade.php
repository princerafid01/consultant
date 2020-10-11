    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Design & Developed By <b>Geeks.</b>
        </div>
        <strong>Copyright &copy; 2020-2040 <a href="#">Geeks</a>.</strong> All rights
        reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
</div>

<!-----------Internal Links---------->
<script src="/public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/public/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/public/dist/js/irange.min.js"></script>
<script src="/public/dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
<!-- fullCalendar -->
<script src="/public/bower_components/moment/moment.js"></script>
<script src="/public/bower_components/fullcalendar/fullcalendar.min.js"></script>
<script src="/public/frontend/js/jquery.datatable.min.js"></script>

<!-----------Active Menu---------->
<script>
  setTimeout(function() {
    $('#goAway').fadeOut('fast');
}, 2000); // <-- time in milliseconds
$(document).ready(function() {
var url = window.location.href;
url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
url = url.substr(url.lastIndexOf("/") + 1);
if(url == ''){
url = 'index.php';
}
$('aside li').each(function(){
var href = $(this).find('a').attr('href');
if(url == href){
$(this).addClass('active');
}
});
});
</script>

<!-----------Range Slider---------->
<script>
	moreProductsSlider();
function moreProductsSlider() {
  // Cache elements
  var $productsOuter = $(".vs-products-outer");
  // Get row height
  var rowHeight = $(".vs-slides-inner").height();
  // Set control click state
  var canClick = true;

  // Slide Up
  $(".vs-control.down").click(function () {
    var $activeRow = $(".vs-products.active");

    // Check if there is a next row to slide to
    if ($activeRow.next().length && canClick) {
      canClick = false;
      // Get animation distance
      var distance = -(parseInt($activeRow.data("row-num")) * rowHeight);

      $productsOuter.velocity(
        {
          top: distance
        },
        500,
        function () {
          canClick = true;
          // Change active row
          $activeRow.removeClass("active").next().addClass("active");
          // Activate other control
          $(".vs-control.up").removeClass("deactivate");

          // If there is no next row
          if (!$(".vs-products.active").next().length) {
            $(".vs-control.down").addClass("deactivate");
          }
        }
      );
    }
  });

  // Slide Down
  $(".vs-control.up").click(function () {
    var $activeRow = $(".vs-products.active");

    // Check if there is a next row to slide to
    if ($activeRow.prev().length && canClick) {
      canClick = false;
      // Get animation distance
      var distance = -(parseInt($activeRow.data("row-num") - 2) * rowHeight);

      $productsOuter.velocity(
        {
          top: distance
        },
        500,
        function () {
          canClick = true;
          // Change active row
          $activeRow.removeClass("active").prev().addClass("active");
          // Activate other control
          $(".vs-control.down").removeClass("deactivate");

          // If there is no next row
          if (!$(".vs-products.active").prev().length) {
            $(".vs-control.up").addClass("deactivate");
          }
        }
      );
    }
  });

  return this;
}
</script>

<!----------Active Range---------->
<script>
    $(document).ready(function() {
        $('button').click(function() {
            $('button.btn.active').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>



<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@yield('js')

</body>
</html>