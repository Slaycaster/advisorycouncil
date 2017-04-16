@extends('module.home')

@section('homesection')
	<div class = "four wide column">
		<div class = "ui segment summcon" id="summary">

				<div class = "ui con">
					<div class="ui container">
						<div class = "summhead">
							<i class = "pie chart medium icon"></i>
								Summary
						</div>

						<div class = "summcontent">

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel"><i title="Show List" onmouseup = "getList(0)" name="expbtn" class ="tiny plus square icon expandbtn"></i>&nbsp;Today's Birthday: <span class = "labeldesc">{{ $tdaycount }}</span></label>
								<div name = "namelist">

									
								</div>
								
							</div>
							
							<div class ="twelve wide column  bspacing8">
								<label class="formlabel"><i title="Show List" onmouseup="getlist(1)" name="expbtn" class ="tiny plus square icon expandbtn"></i>&nbsp;Upcoming Birthdays: <span class = "labeldesc">{{ $ubday }}</span></label>
								<div name ="namelist">
									
								</div>	
							</div>

							<br>
							
							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">% of AC: <span class = "labeldesc">{{ $pac }}%</span></label>
										
							</div>

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">No. of AC: <span class = "labeldesc">{{ $ac }}</span></label>
											
							</div>

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">% of PSMU: <span class = "labeldesc">{{ $ppsmu }}%</span></label>
											
							</div>

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">No. of PSMU: <span class = "labeldesc">{{ $psmu }}</span></label>
										
							</div>

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">% of TWG: <span class = "labeldesc">{{ $ptwg }}%</span></label>
											
							</div>

							<div class ="twelve wide column  bspacing8">
								<label class="formlabel">No. of TWG: <span class = "labeldesc">{{ $twg }}</span></label>
											
							</div>

							

							<br>

							<div class ="twelve wide column bspacing8">
								<label class="formlabel">Total No. of Adviser: <span class = "labeldesc">{{ $all }}</span></label>
											
							</div>

							

										
						</div>
											
					</div>
								
				</div>
							

								
						
		</div>
					
	</div>
						

	<div class = "twelve wide column">
		<div class = "hcontent">
			<div class="dcon">
				<div class = "tablepane">
					<div class = "mtitle">Dashboard</div>

					<div class= "ui grid"> 
						
						<div class = "one column row gridrowstyle">
							
							<div class = "six wide column">
								<div class="row" id="unit-chart">
									
								</div>
								{!! Lava::render('PieChart', 'UnitOffices', 'unit-chart'); !!}
								
							</div>

							<div class = "nine wide column">
								<div class="row" id="second-chart">
									
								</div>
								
								{!! Lava::render('ColumnChart', 'UnitSecondOffices', 'second-chart'); !!}
								
							</div>
						</div>

						<div class = "one column row">
							
							<div class = "sixteen wide column">
								<div class="row" id="ter-chart">
									
								</div>
								{!! Lava::render('ColumnChart', 'UnitTerOffices', 'ter-chart'); !!}
								
							</div>

						</div>

						<div class = "one column row">

							<div class = "sixteen wide column">
								<div class="row" id="quar-chart">
									
								</div>
								
								{!! Lava::render('ColumnChart', 'UnitQuarOffices', 'quar-chart'); !!}
								
							</div>
						</div>

						<div class = "one column row">
							<div class = "eight wide column">
								<div class="row" id="age-chart">
									
								</div>
								{!! Lava::render('PieChart', 'Age', 'age-chart'); !!}
								
							</div>
							
							<div class = "eight wide column">
								<div class="row" id="gender-chart">
									
								</div>
								{!! Lava::render('PieChart', 'Gender', 'gender-chart'); !!}
								
							</div>
							
						</div>


						<div class ="one column row">
							<div class = "eight wide column">
								<div class = "row " id="acposition-chart">
									
								</div>
								{!! Lava::render('PieChart', 'ACPosition', 'acposition-chart'); !!}
								
							</div>

							<div class = "neight wide column">
								<div class="row" id="policeposition-chart">
									
								</div>
								{!! Lava::render('PieChart', 'PolicePosition', 'policeposition-chart'); !!}
								
							</div>

						</div>

						<div class ="one column row">
							<div class = "sixteen wide column">
								<div class="row" id="sector-chart">
									
								</div>
								{!! Lava::render('ColumnChart', 'Sector', 'sector-chart'); !!}
								
							</div>

							

							

						</div>

						
						

					</div>
			
				</div>
		
			</div>
						
		</div>
					
	</div>

	<script type="text/javascript">

		function getlist(index) {
			var namelistitem = document.getElementsByName('namelist')[index];

			//if(jQuery.inArray("plus", (document.getElementsByName('expbtn')[index].classList) > -1)) {
				var url="";

				$("div[name='namelist']").eq(index).empty();


				if(index == 0 ) {
					url = "{{url('birthdays')}}";
				} else if(index == 1) {
					url = "{{url('upcomings')}}";

				}//if

				var data = {'_token' : '{{ Session::token() }}'};
				var value;

				$("div[name='namelist']").empty();
				$("i[name='expbtn']").eq(index).removeClass('plus');
				$("i[name='expbtn']").eq(index).addClass('minus');
				$("i[name='expbtn']").eq(index).attr('title', "Hide List");
				$("i[name='expbtn']").eq(index).attr('onmouseup', 'hidelist('+index+')');

				$.ajax({

					type: "POST",
					url: url,
					data: data,
					dataype: "JSON",
					success:function(data){



						for (var count = 0 ; count < data[0].length ; count++) {
							value = data[0][count]['fname'] + " " + data[0][count]['mname'] + " " + data[0][count]['lname'] + " (AC)";
							
							if(index == 1) {
								value = value + " on " + data[0][count]['fbd'];
							}//if

							createlist(index, value);

						};

						for (var count1 = 0 ; count1 < data[1].length ; count1++) {
							value = data[1][count1]['fname'] + " " + data[1][count1]['mname'] + " " + data[1][count1]['lname'];

							if(data[1][count1]['policetype'] == 1) {
								var type = "TWG";
							} else {
								var type = "PSMU";
							}//if

							createlist(index, value + " (" + type + ")");
						};
						
					},
					error:function() {
						$('#errormodal').modal('show');
					} 

				});
					

			/*} else if(jQuery.inArray("minus", (document.getElementsByName('expbtn')[index].classList) > -1)){
				$("div[name='namelist']").eq(index).empty();
				$("i[name='expbtn']").eq(index).removeClass('minus');
				$("i[name='expbtn']").eq(index).addClass('plus');
				$("i[name='expbtn']").eq(index).attr('title', "Show List");

			}//if*/

		}//getList

		function hidelist(index) {
			$("div[name='namelist']").eq(index).empty();
			$("i[name='expbtn']").eq(index).removeClass('minus');
			$("i[name='expbtn']").eq(index).addClass('plus');
			$("i[name='expbtn']").eq(index).attr('title', "Show List");
			$("i[name='expbtn']").eq(index).attr('onmouseup', "getlist("+index+")");

		}//hidelist

	</script>

	<script type="text/javascript" src="{{ URL::asset('js/formcontrol.js') }}"></script>
@stop