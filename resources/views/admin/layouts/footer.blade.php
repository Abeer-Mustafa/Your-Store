  	<footer class="main-footer textCenter">
    	<strong>
    		{{ __('dashboard.Copyright') }}
    		<a href="{{ asset('/')}}"> {{ __('dashboard.Your Store') }} </a>
    	</strong> 
    	{{ __('dashboard.All rights reserved') }}.
  	</footer>

</div>

<!-- JS Scripts -->
 
    <!-- jQuery 3 -->
    <script src="{{ asset('admin') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('admin') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   	<!-- DataTabels -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    
    <script src="{{ asset('admin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="{{ asset('admin') }}/dist/js/adminlte.min.js"></script>
	<script src="{{ asset('admin') }}/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('admin') }}/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="{{ asset('admin') }}/dist/js/demo.js"></script>
   
   <!-- DataTabels -->
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

	<!-- Morris.js charts -->
    <!-- <script src="{{ asset('admin') }}/bower_components/raphael/raphael.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/bower_components/morris.js/morris.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
	<!-- jQuery Knob Chart -->
    <!--  <script src="{{ asset('admin') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/bower_components/moment/min/moment.min.js"></script> -->
    <!-- <script src="{{ asset('admin') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
    

	<!-- <script src="{{ asset('admin') }}/bower_components/select2/dist/js/select2.full.min.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/plugins/input-mask/jquery.inputmask.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/plugins/input-mask/jquery.inputmask.date.extensions.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/plugins/input-mask/jquery.inputmask.extensions.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script> -->
	<!-- <script src="{{ asset('admin') }}/plugins/timepicker/bootstrap-timepicker.min.js"></script> -->
    
    <script src="{{ asset('admin') }}/script.js"></script>
	
<script>
	$(function () {
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      	checkboxClass: 'icheckbox_flat-green',
	      	radioClass   : 'iradio_flat-green'
	    })
   	})
</script>

	<!-- <script>
	  	$.widget.bridge('uibutton', $.ui.button);
	</script> -->

	<!-- Page script -->
	<!-- <script>
	  	$(function () {
		    //Initialize Select2 Elements
		    $('.select2').select2()

		    //Datemask dd/mm/yyyy
		    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		    //Datemask2 mm/dd/yyyy
		    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
		    //Money Euro
		    $('[data-mask]').inputmask()

		    //Date range picker
		    $('#reservation').daterangepicker()
		    //Date range picker with time picker
		    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
		    //Date range as a button
		    $('#daterange-btn').daterangepicker(
		      {
		        ranges   : {
		          'Today'       : [moment(), moment()],
		          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
		          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
		          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		        },
		        startDate: moment().subtract(29, 'days'),
		        endDate  : moment()
		      },
		      function (start, end) {
		        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
		      }
		    )

		    //Date picker
		    $('#datepicker').datepicker({
		      autoclose: true
		    })

		    //iCheck for checkbox and radio inputs
		    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		      checkboxClass: 'icheckbox_minimal-blue',
		      radioClass   : 'iradio_minimal-blue'
		    })
		    //Red color scheme for iCheck
		    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		      checkboxClass: 'icheckbox_minimal-red',
		      radioClass   : 'iradio_minimal-red'
		    })
		    //Flat red color scheme for iCheck
		    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		      checkboxClass: 'icheckbox_flat-green',
		      radioClass   : 'iradio_flat-green'
		    })

		    //Colorpicker
		    $('.my-colorpicker1').colorpicker()
		    //color picker with addon
		    $('.my-colorpicker2').colorpicker()

		    //Timepicker
		    $('.timepicker').timepicker({
		      showInputs: false
		    })
	  })
	</script> -->
@stack('AJAX')
@stack('SelectCountries')

</body>
</html>