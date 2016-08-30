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
	/*#loading {*/
	/*   width: 100%;*/
	/*   height: 100%;*/
	/*   top: 0;*/
	/*   left: 0;*/
	/*   position: fixed;*/
	/*   display: block;*/
	/*   opacity: 0.7;*/
	/*   background-color: #fff;*/
	/*   z-index: 99;*/
	/*   text-align: center;*/
	/*}*/
	/*#loading-image {*/
	/*  position: absolute;*/
	/*  top: 100px;*/
	/*  left: 240px;*/
	/*  z-index: 100;*/
	/*}*/
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

		$('#generateCode').on('click', function(e) {
			var passphrase = $('#passphrase').val();
			var minLength = 4;
			if (passphrase.length < minLength) {
				$('#lbVerification').text('Passphrase is less than four characters');
			} else {
				var urlString = "passphrase="+ passphrase;
				$.ajax({
					type: "GET",
					url: "devices/verify",
					data: urlString,
					success: function(responseText) {
						$('#lbVerification').text('Your Verification Code is: ' + responseText);
					}
				});
			}
		});

		$('.associateKid').on('click', function(e) {
			//Get current button and change layout accordingly
			var currentElement = e.target;
			//To solve event capturing issues that accidentally captures the nested element
			if (currentElement.tagName == "SPAN") {
				currentElement = currentElement.parentNode;
			}
			var deviceId = currentElement.getAttribute("data-id");
			var editingButtonElement = currentElement;
			var childArray = editingButtonElement.childNodes;

			if (editingButtonElement.getAttribute("editing") == "false") {
				editingButtonElement.setAttribute("editing", "true");
				for (var i = 0; i < childArray.length; i++) {
					if (childArray[i].tagName == "SPAN") {
						childArray[i].className = "glyphicon glyphicon-ok";
					}
				}

				//Find the corresponding column
				currentElement = currentElement.parentNode;
				do {
					currentElement = currentElement.previousSibling;
				} while (currentElement.className != "kidColumn");
				var kidColumn = currentElement;
				do {
					currentElement = currentElement.previousSibling;
				} while (currentElement.className != "nameColumn");
				var nameColumn = currentElement;

				//Alter name field
				var deviceName = nameColumn.innerHTML;
				var nameField = document.createElement("INPUT");
				nameField.value = deviceName;
				nameColumn.innerHTML = "";
				nameColumn.appendChild(nameField);

				//Alter kid field
				kidColumn.innerHTML = "";
				var kidSelectionList = document.createElement("SELECT");
				kidColumn.appendChild(kidSelectionList);

				var urlString = "deviceId=" + deviceId;
				$.ajax ({
					type: "GET",
					url: "devices/getKid",
					data: urlString,
					success: function(responseText) {
						var kidObjectArray = JSON.parse(responseText);
						var preselectedKidId = -1;
						var index = 1;
						var notAssociated = false;
						for (var kidId in kidObjectArray) {
							var kidDescription = kidObjectArray[kidId];
							if (kidId == 0 && index == 1) {
								preselectedKidId = kidDescription;
							} else {
								var listElement = document.createElement("OPTION");
								listElement.setAttribute("kidId", kidId);
								listElement.innerHTML = kidDescription;
								if (preselectedKidId == kidId) {
									listElement.selected = true;
								}
								if (kidId == -1) {
									if (preselectedKidId == -1) {
										notAssociated = true;
									}
								}
								if (!notAssociated) {
									kidSelectionList.appendChild(listElement);
								}
							}
							index++;
						}
					}
				});
			} else {
				//Find the corresponding column
				currentElement = currentElement.parentNode;
				do {
					currentElement = currentElement.previousSibling;
				} while (currentElement.className != "kidColumn");
				var kidColumn = currentElement;
				do {
					currentElement = currentElement.previousSibling;
				} while (currentElement.className != "nameColumn");
				var nameColumn = currentElement;

				//Alter name field
				var nameInputField = nameColumn.firstChild;
				var deviceName = nameInputField.value;

				if (deviceName == "") {
					nameColumn.style.backgroundColor = 'red';
				} else {
					nameColumn.innerHTML = deviceName;

					//Send the changed name to the database
					var urlString = "deviceId=" + deviceId + "&deviceName=" + deviceName;
					$.ajax({
						type: "GET",
						url: "devices/changeName",
						data: urlString,
						success: function() {
							nameColumn.style.backgroundColor = 'white';
						}
					});

					//Find the selected option and alter kid column
					var kidList = kidColumn.firstChild;
					var selectedKid = kidList.options[kidList.selectedIndex];
					var kidId = selectedKid.getAttribute('kidId');
					if (kidId == -1) {
						kidColumn.innerHTML = "None";
						kidColumn.style.border = "none";
					} else {
						kidColumn.innerHTML = selectedKid.innerHTML;
						var currentKidId;
						$.ajax ({
							type: "GET",
							url: "getCurrentKid",
							success: function(responseText) {
								if (kidId == responseText) {
									kidColumn.style.border = "1px solid red";
									var kidName = kidColumn.innerHTML;
									kidColumn.innerHTML = "";
									var highlightElement = document.createElement("STRONG");
									highlightElement.innerHTML = kidName;
									kidColumn.appendChild(highlightElement);
								} else {
									kidColumn.style.border = "none";
								}
							}
						});
					}

					//Update the associated kid to the database
					var urlString = "deviceId=" + deviceId + "&kidId=" + kidId;
					$.ajax({
						type:"GET",
						url: "devices/associateKid",
						data: urlString
					});

					//Alter layout after processing is finished
					editingButtonElement.setAttribute("editing", "false");
					for (var i = 0; i < childArray.length; i++) {
						if (childArray[i].tagName == "SPAN") {
							childArray[i].className = "glyphicon glyphicon-pencil";
						}
					}
				}
			}
		});

		$('#GCMMessageModel').on('show.bs.modal', function(e) {
			var id =  $(e.relatedTarget).data('id');
			var dir="/GCM/"+id;
			$('#GCMForm').attr('action', dir);
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
	var arr=['{{route("beacons")}}','{{route("devices")}}','{{route("calls")}}','{{route("sms")}}',
	'{{route("location")}}','{{ url("/panics") }}'];	//add all route here
		$('.select_button').on('click', function(e) {
			$('div[class*="box-profile"]').removeClass('well');
			$(e.target).parent().parent().parent().addClass('well');
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

			if (typeof(Storage) !== "undefined") {
				if($('#date_timepicker_start').val()!==""){
				localStorage.setItem("localStartTime", $('#date_timepicker_start').val());
				}

				if($('#date_timepicker_end').val()!==""){
				localStorage.setItem("localEndTime", $('#date_timepicker_end').val());
				}
			}

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
