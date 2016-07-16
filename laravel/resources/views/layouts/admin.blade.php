@section('title')
	SCKid - Dashboard
@append
@section('customStyle')
	<!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <!--other CSS-->
    <link href="/css/AdminLTE.css" rel="stylesheet">
    <link href="/css/AdminLTE.min.css" rel="stylesheet">
@append
@include('includes.header')

@include('includes.sidebar')
@yield('content')

@section('customFunction')
	{{--This is our script for deleting and should be in here not in our home view--}}
	<script>
	   	$('#delete').on('show.bs.modal', function(e) {
	   		var action = "/destroy/";
	   		var id =  $(e.relatedTarget).data('id');
	   		var dir =  "/" + $(e.relatedTarget).data('dir') + action;
	   		$('#delModal').attr('action', dir + id);
	   	});

		$('#deletePolicy').on('show.bs.modal', function(e) {
	   		//var action = "/destroy/";
	   		//var dir =  $(e.relatedTarget).data('dir');// + action;

			var id =  $(e.relatedTarget).data('id');
			var dir="/policy/delete/"+id;
			$('#delPolicy').attr('action', dir);
			// var dir =  $(e.relatedTarget).data('dir');
			//  		$('#delPolicy').attr('action', dir);
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

	<script>
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
				}
			});

		});
	</script>

	<!-- Custom Theme JavaScript -->
	{{--<script src="/js/sb-admin-2.js"></script>--}}
@append
@include('includes.footer')
