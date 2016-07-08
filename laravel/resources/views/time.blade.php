@extends('layouts.admin')
@section('content')


	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Time Restrictions</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Set Times for:
								<button>{{Session::get('current_kid_name')}}</button>
							</h3>
						</div>
						<div class="box-body">

							{{--<table style="border:1px solid black">--}}
								{{--<thead>--}}
								{{--<td>--}}
									{{--<button id="previousButton">Previous</button>--}}
								{{--</td>--}}
								{{--<td id="currentDay"> </td>--}}
								{{--<td>--}}
									{{--<button id="nextButton">Next</button>--}}
								{{--</td>--}}
								{{--</thead>--}}
								{{--<tbody id="timeSlots"> </tbody>--}}
							{{--</table>--}}


							<table id="datatable" class="table table-bordered table-hover">
								<thead>
								<td>
									<button id="previousButton">Previous</button>
								</td>
								<td id="currentDay"> </td>
								<td>
									<button id="nextButton">Next</button>
								</td>
								</thead>
								<tbody id="timeSlots"> </tbody>

							</table>

							<hr>

						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
	</div>

	
	<script defer>
		var dayInWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		var startingDayIndex = 0;
		var currentTimeSlots;
		
		//Initialise
		currentTimeSlots = new timeSlotsTable(startingDayIndex);
		document.getElementById("previousButton").onclick = function() {
			var newIndex = currentTimeSlots.getDayIndex() - 1;
			if (newIndex < 0) {
				newIndex += dayInWeek.length;
			}
			currentTimeSlots.setDayIndexAndChange(newIndex);
		};
		document.getElementById("nextButton").onclick = function() {
			var newIndex = currentTimeSlots.getDayIndex() + 1;
			if (newIndex > dayInWeek.length - 1) {
				newIndex -= dayInWeek.length;
			}
			currentTimeSlots.setDayIndexAndChange(newIndex);
		};
		
		//Timeslot constructor
		function timeSlotsTable(startingDayIndex){
			var dayIndex = startingDayIndex;
			
			var startTime = 0,
				endTime = 24;
			var hourString = "",
				minuteString = "";
			var currentHour = startTime,
				currentMinute = 0;
			var hourRow,
				minuteColumn;
			var hourCycle = 2;
			
			var hourClassWord = "h hour";
			var minuteClassWord = "m minute";
			
			var selectedSlots = [];
			var selectedIndex = 0;
			
			//TODO record selected slots
			
			var ui = {
				parentContainer : document.getElementById("timeSlots"),//TODO flexible parent container
				
				dayContainer : document.getElementById("currentDay"),//TODO create fixed container
				
				hourRow : null,
				hourColumn : null,
				minuteColumn :null,
				
				managingRow : document.createElement("TR"),
				scheduleButtonColumn : document.createElement("TD"),
				clearButtonColumn : document.createElement("TD"),
				scheduleButton : document.createElement("BUTTON"),
				clearButton : document.createElement("BUTTON")
			};
			
			var createTimeSlot = function() {
				//Display current day
				ui.dayContainer.innerHTML = dayInWeek[dayIndex];
				//Display time slots
				do {
					for (var i = 1; i <= hourCycle; i++) {
						ui.hourRow = document.createElement("TR");
						ui.hourColumn = document.createElement("TD");
						ui.minuteColumn = document.createElement("TD");
						
						if (currentHour < 10) {
							hourString = "0" + currentHour;
						} else {
							hourString = currentHour;
						}
						
						if (currentMinute == 0) {
							minuteString = "00";
							currentMinute = 30;
						} else {
							minuteString = "30";
							currentMinute = 0;
							currentHour++;
						}
						
						ui.hourRow.className = hourClassWord + hourString;
						ui.minuteColumn.className = minuteClassWord + minuteString;
						
						if (i == 1) {
							ui.hourColumn.innerHTML = hourString + ": ";	
						}
						ui.minuteColumn.innerHTML = minuteString + (i == 1 ? "--30" : "--60");
						
						//Add events for minute columns
						ui.minuteColumn.onclick = function(e) {
							//Check if current slot is selected
							//TODO better check condition, remove this slot if selected instead of alerting
							if (this.style.backgroundColor != "blue") {
								var hour = e.target.parentNode.className.substring(hourClassWord.length + 1 - 1);
								var minute = e.target.className.substring(minuteClassWord.length + 1 - 1);
								var timeValue = parseInt(hour) + (parseInt(minute) == 0 ? 0 : 0.5);
								
								//Store the slot information
								selectedSlots[selectedIndex] = {
									hourString : hour,
									minuteString : minute,
									sortingValue : timeValue 
								};
								selectedIndex++;
								
								//Alter CSS
								this.style.backgroundColor = "blue";	
							} else {
								alert("already selected");
							}
						}
						
						ui.minuteColumn.onmouseover = function() {
							this.style.border = "1px solid red";
							this.parentNode.style.border = "1px solid green";
						}
						ui.minuteColumn.onmouseout = function() {
							this.style.border = "none";
							this.parentNode.style.border = "none";
						}
						
						//Arrange DOM
						ui.hourRow.appendChild(ui.hourColumn);
						ui.hourRow.appendChild(ui.minuteColumn);
						ui.parentContainer.appendChild(ui.hourRow);
					}
				} while (currentHour < endTime);
				
				//Set attributes for slot managing buttons
				ui.scheduleButton.id = "scheduleButton";
				ui.scheduleButton.innerHTML = "Schedule";
				ui.clearButton.id = "clearButton";
				ui.clearButton.innerHTML = "Clear All Selected";
				
				//Add events for slot managing buttons
				ui.scheduleButton.onclick = function() {
					//Sort the array
					var compareFunction = function(a, b) {
						return a.sortingValue - b.sortingValue;
					}
					selectedSlots.sort(compareFunction);
					
					
					//Prepare data to send to database;
					var allTimeSlots = [];
					for (var i = 0; i < selectedSlots.length; i++) {
						allTimeSlots.push(selectedSlots[i].hourString + ":" + selectedSlots[i].minuteString);
					}
					var dayData = "day=" + dayInWeek[dayIndex];
					var slotsData = "slots=" + JSON.stringify(allTimeSlots);
					var routeURL = "arrangeTimeSlots";
					var dataString = dayData + "&" + slotsData;
					
					//Make AJAX request
					$.ajax
					({
						url: routeURL,
						type: "GET",
						data: dataString,
						success: function(responseText) {
							alert(responseText);
						}
					});
					
				}
				ui.clearButton.onclick = function() {
					//Clear storage
					selectedSlots = [];
					selectedIndex = 0;
					
					//Clear CSS
					minuteColumns = document.getElementsByClassName("m");
					for (var i = 0; i < minuteColumns.length; i++) {
						minuteColumns[i].style.backgroundColor = "inherit";
					}
				}
				
				//Arrange DOM
				ui.scheduleButtonColumn.appendChild(ui.scheduleButton);
				ui.clearButtonColumn.appendChild(ui.clearButton);
				ui.managingRow.appendChild(ui.scheduleButtonColumn);
				ui.managingRow.appendChild(ui.clearButtonColumn);
				ui.parentContainer.appendChild(ui.managingRow);
			}
			
			//Getter and setter methods
			this.getDayIndex = function() {
				return dayIndex;
			}
			
			this.setDayIndexAndChange = function(newIndex) {
				dayIndex = newIndex;
				ui.dayContainer.innerHTML = dayInWeek[dayIndex];
			}
			
			//Execute the object instantiated
			createTimeSlot();
		}
		
	</script>
@endsection