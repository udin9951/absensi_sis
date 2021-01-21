<div class="row">
  <div class="col-md-12">
    <div class="copyright">
      <p>@Aplikasi Absensi Berbasis Website Menggunakan Codeignitier.</p>
    </div>
  </div>
</div>
</div>
</div>
</div>



</div>

</div>

<!-- Jquery JS-->
<script src="<?php echo base_url(''); ?>asset/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="<?php echo base_url(''); ?>asset/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="<?php echo base_url(''); ?>asset/vendor/slick/slick.min.js">
</script>
<script src="<?php echo base_url(''); ?>asset/vendor/wow/wow.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/animsition/animsition.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="<?php echo base_url(''); ?>asset/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="<?php echo base_url(''); ?>asset/vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/select2/select2.min.js"></script>

<!-- full calendar requires moment along jquery which is included above -->
<script src="<?php echo base_url(''); ?>asset/vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
<script src="<?php echo base_url(''); ?>asset/vendor/fullcalendar-3.10.0/fullcalendar.js"></script>



<!-- Main JS-->
<script src="<?php echo base_url(''); ?>asset/js/main.js"></script>
<script src="<?php echo base_url(''); ?>asset/js/bootstrap-datepicker.js"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
  $(function() {

    $('#bulan').on('change', function() {
      bulan = this.value

      $('#get_bulan').val(bulan)
    });

    $('#liat_password').on('click', function() {
      if ($(this).is(':checked')) {
        $('#password').attr('type', 'text');
      } else {
        $('#password').attr('type', 'password');
      }
    });

    $('[data-toggle="popover"]').popover();

    // for now, there is something adding a click handler to 'a'
    var tues = moment().day(2).hour(19);

    // build trival night events for example data
    var events = [{
        title: "Special Conference",
        start: moment().format('YYYY-MM-DD'),
        url: '#'
      },
      {
        title: "Doctor Appt",
        start: moment().hour(9).add(2, 'days').toISOString(),
        url: '#'
      }

    ];

    var trivia_nights = []

    for (var i = 1; i <= 4; i++) {
      var n = tues.clone().add(i, 'weeks');
      console.log("isoString: " + n.toISOString());
      trivia_nights.push({
        title: 'Trival Night @ Pub XYZ',
        start: n.toISOString(),
        allDay: false,
        url: '#'
      });
    }

    // setup a few events
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      events: events.concat(trivia_nights)
    });
  });

  function initialize() {
    var latitude = $('#latitude').val()
    var longitude = $('#longitude').val()
    var latitude_rumah = $('#latitude_rumah').val()
    var longitude_rumah = $('#longitude_rumah').val()
    var propertiPeta = {
      center: new google.maps.LatLng(latitude, longitude),
      zoom: 9,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

    // membuat Marker
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(latitude, longitude),
      map: peta,
      animation: google.maps.Animation.BOUNCE
    });

    var marker2 = new google.maps.Marker({
      position: new google.maps.LatLng(latitude_rumah, longitude_rumah),
      map: peta,
      animation: google.maps.Animation.BOUNCE
    });

  }

  // event jendela di-load  
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
  $(function() {
    $(".datepicker").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
    });
  });
</script>

</body>

</html>
<!-- end document-->