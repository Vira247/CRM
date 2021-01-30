<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-daygrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-timegrid/main.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar-bootstrap/main.min.css')); ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inquiry</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>/home">Home</a></li>
            <li class="breadcrumb-item active">Inquiry</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body p-0">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
<!-- /.content-wrapper -->
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-daygrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-interaction/main.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/fullcalendar-timegrid/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/fullcalendar-bootstrap/main.min.js')); ?>"></script>
<script>
  $(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    var calendar = new Calendar(calendarEl, {
      plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      },
      'themeSystem': 'bootstrap',
      //Random default events
      events: function(fetchInfo, successCallback, failureCallback) {
        start = fetchInfo.startStr.valueOf();
        end = fetchInfo.endStr.valueOf();
        jQuery.ajax({
          url: 'getfollowuplist',
          type: 'GET',
          dataType: 'json',
          data: {
            start: start,
            end: end
          },
          success: function(doc) {
            var events = [];
            if (!!doc) {
              $.map(doc, function(r) {
                events.push({
                  id: r.id,
                  title: r.title,
                  start: r.start
                });
              });
            }
            console.log(events);
            successCallback(events);
          }
        });
      },
      eventClick: function(info) {
        events = info.event;
        window.open("<?php echo URL::TO('inquiry/'); ?>/"+events.id, '_blank');
      },
      editable: false,
      droppable: false, // this allows things to be dropped onto the calendar !!!
    });
    calendar.render();
  })
</script><?php /**PATH C:\xamppnew\htdocs\laravel_demo\resources\views/inquiry/follow_calendar.blade.php ENDPATH**/ ?>