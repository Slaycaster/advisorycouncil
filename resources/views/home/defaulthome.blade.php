@extends('module.home')

@section('homesection')
	<div class = "four wide column">
		<div class = "ui segment summcon" id="summary">
			<div class = "ui rail">
				<div class = "ui con">
					<div class="ui container">
						<div class = "summhead">
							<i class = "pie chart medium icon"></i>
								Summary
						</div>

						<div class = "summcontent">
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
					
	</div>

	<div class = "twelve wide column">
		<div class = "hcontent">
			<div class="dcon">
				<div class = "tablepane">
					<div class = "mtitle">Dashboard</div>

					<div class= "ui grid">
						<div class = "eight wide column">
							<div class='row' id="gender-chart"></div>
							{!! Lava::render('PieChart', 'Gender', 'gender-chart'); !!}
						</div>



						<div class = "eight wide column">
							<div class="row" id="sector-chart">
								<div id="sectorchart">
						        </div>
						        <div id="sectorcontrol">
						        </div>
							</div>
							{!! Lava::render('Dashboard', 'Sector', 'sector-chart'); !!}
							
						</div>

						<div class = "eight wide column">
							<div class="row" id="age-chart">
								<div id="chart">
						        </div>
						        <div id="control">
						        </div>
							</div>
							{!! Lava::render('Dashboard', 'Age', 'age-chart'); !!}
							
						</div>

						<div class = "eight wide column">
							<div class="row" id="unit-chart">
								<div id="unitchart">
						        </div>
						        <div id="unitcontrol">
						        </div>
							</div>
							{!! Lava::render('Dashboard', 'UnitOffices', 'unit-chart'); !!}
							
						</div>

						
						
					</div>
						
						


			
				</div>
		
			</div>
						
		</div>
					
	</div>


@stop