@section('title')
	SCKid - Dashboard
@append
@section('customStyle')
	<!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <!--other CSS-->
    <link href="/css/AdminLTE.css" rel="stylesheet">
    <link href="/css/AdminLTE.min.css" rel="stylesheet">

	<!-- timepicker -->
	<link href="/css/jquery.datetimepicker.css" rel="stylesheet">
	<style>

	</style>
@append
@include('includes.header')

@include('includes.sidebar')
@include('includes.popupModal')

@yield('content')

@section('customFunction')
<script>
jQuery(function(){
	jQuery('#date_timepicker_start').datetimepicker({
		format:'Y/m/d',
		onShow:function( ct ){
			this.setOptions({
				maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
			})
		},
		timepicker:false
	});
	jQuery('#date_timepicker_end').datetimepicker({
		format:'Y/m/d',
		onShow:function( ct ){
			this.setOptions({
				minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
			})
		},
		timepicker:false
	});
});
</script>
	{{--This is our script for deleting and should be in here not in our home view--}}
	<script>
	   	$('#delete').on('show.bs.modal', function(e) {
	   		var action = "/destroy/";
	   		var id =  $(e.relatedTarget).data('id');
	   		var dir =  "/" + $(e.relatedTarget).data('dir') + action;
	   		$('#delModal').attr('action', dir + id);
	   	});

		$('#deletePolicy').on('show.bs.modal', function(e) {
			var id =  $(e.relatedTarget).data('id');
			var dir="/policy/delete/"+id;
			$('#delPolicy').attr('action', dir);
	   	});

		$('#verifyDevice').on('show.bs.modal', function(e) {
			$.ajax({
				method: 'GET',
				url: '{{route("verify.devices")}}',
			})
			.done(function(responseText) {
				$('#lbVerification').text('Your Verification Code is: ' + responseText);
			});
		});
	</script>

	{{--THESE ARE FOR APPS--}}
	<script>
	    $(function () {
	        $("#datatable").DataTable();
	    });

	</script>
	<script>
	    $('.probeProbe').bootstrapSwitch();
	</script>

	<script>
	    $('.probeProbe').on('switchChange.bootstrapSwitch', function (event, state) {
	        if (state == true){
	            action = 1;
	        }else if(state==false){
	            action = 0 ;
	        }
	        //alert(state);
	        var id = event.target.value;
	        //alert(event.target.value);
	        var urlString = "id="+id +"&action="+action;
	        $.ajax
	        ({
	            url: "apps",
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            type: "PUT",
	            cache: false,
	            dataType:"json",
	            data: urlString
	        });
	    });
	</script>

{{--THESE ARE FOR CHECKING IF THE ROUTE NEEDS TO REDIRECT BACK--}}
	<script>
	var arr=['{{route("beacons")}}','{{route("deviecs")}}','{{route("calls")}}','{{route("sms")}}',
	'{{route("location")}}','{{ url("/panics") }}'];	//add all route here
		$('.select_button').on('click', function(e) {
			var id = $(e.target).data('id');
			var name = $(e.target).data('kidname');
			var urlString = "id=" + id + "&name=" + name;
			$.ajax
			({
				url: "selectKid",
				type: "GET",
				data: urlString,
				success: function(responseText) {
					$('#kid_text').html("Current Child is: " + responseText);
					for(index in arr){
						if('{{URL::previous()}}' === arr[index]){
						   window.location="{{URL::previous()}}";
						 }
				 	}
				}
			});
		});

		$('.stats_select').on('click', function(e) {
			var id = $(e.target).data('id');
			var name = $(e.target).data('kidname');
			var start_timepick=$('#date_timepicker_start').val();
			var end_timepick=$('#date_timepicker_end').val();
			var urlString = "id=" + id + "&name=" + name + "&startPickTime=" + start_timepick + "&endPickTime=" + end_timepick;
			$.ajax
			({
				url: "selectKid",
				type: "GET",
				data: urlString,
				success: function(responseText) {
					$('#kid_text').html("Current Child is: " + responseText);
					window.location="{{URL::current()}}";
				}
			});
		});
	</script>

	<!-- Custom Theme JavaScript -->
	{{--<script src="/js/sb-admin-2.js"></script>--}}
@append
@include('includes.footer')
