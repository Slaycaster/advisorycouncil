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

					<br>

						<div class='row' id="gender-chart"></div>
						{!! Lava::render('DonutChart', 'Gender', 'gender-chart'); !!}
						<div class="row" id="sector-chart"></div>
						{!! Lava::render('DonutChart', 'Sector', 'sector-chart'); !!}

					@if(sizeof($acmember) != 0)
						<h6 class="ui horizontal divider divtitle">
							Advisory Council
						</h6>

						<div id = "accardlist" class = "ui doubling grid cardlist2">

							@foreach($acmember as $acrec)
								<div class = "five1 wide column colheight">
									<div class = "cardstyle" onclick = "loadModal('0-{{$acrec->ID}}')">
										@if($acrec->imagepath != "")
											<img class = "advphoto" src="{{URL::asset($acrec->imagepath)}}"/>
										@else
											<img class = "advphoto" src="{{URL::asset('objects/Logo/InitProfile.png')}}"/>
										@endif
										<div class = "advdata">
											<h5 class = "name">{{$acrec->lname}}, {{$acrec->fname}} {{$acrec->mname}} (AC)</h5>
											<p class = "p1">
												{{$acrec->acpositionname}} <br>
												{{$acrec->officename}} <br>
												{{$acrec->email}} <br>

												@if($acrec->contactno != "" && $acrec->landline != "")
													{{$acrec->contactno/ $acrec->landline}}
												@else
													@if($acrec->contactno != "")
														{{$acrec->contactno}}
													@elseif($acrec->landline != "")
														{{$acrec->landline}}
													@endif
												@endif
												
												
											</p>

											<p class = "p2"> Member since {{date('M Y',strtotime($acrec->startdate))}}</p>
											
										</div>
									</div>

								</div>
							@endforeach

						</div>

						<br>
					@endif

					@if(sizeof($tpmember) != 0)
						<h4 class="ui horizontal divider divtitle">
							TWG & PSMU
						</h4>

						<div id = "tpcardlist" class = "ui doubling grid cardlist2">

							@foreach($tpmember as $tprec)
								<div class = "five1 wide column colheight">
									<div class = "cardstyle" onclick = "loadModal('{{$tprec->policetype}}-{{$tprec->ID}}')">
										@if($tprec->imagepath != "")
											<img class = "advphoto" src="{{URL::asset($tprec->imagepath)}}"/>
										@else
											<img class = "advphoto" src="{{URL::asset('objects/Logo/InitProfile.png')}}"/>
										@endif
										<div class = "advdata">
											<h5 class = "name">{{$tprec->lname}}, {{$tprec->fname}} {{$tprec->mname}}

												@if($tprec->policetype == 1)
													(TWG)
												@else
													(PSMU)
												@endif
											</h5>
											<p class = "p1">
												{{$tprec->PositionName}} <br>

												@if($tprec->UnitOfficeQuaternaryName != "")
													{{$tprec->UnitOfficeQuaternaryName}} 

												@elseif($tprec->UnitOfficeTertiaryName != "")
													{{$tprec->UnitOfficeTertiaryName}} 

												@elseif($tprec->UnitOfficeSecondaryName != "")
													{{$tprec->UnitOfficeSecondaryName}} 

												@else
													{{$tprec->UnitOfficeName}} 

												@endif

												<br>

												{{$tprec->email}} <br>

												@if($tprec->contactno != "" && $tprec->landline != "")
													{{$tprec->contactno/ $tprec->landline}}
												@else
													@if($tprec->contactno != "")
														{{$tprec->contactno}}
													@elseif($tprec->landline != "")
														{{$tprec->landline}}
													@endif
												@endif
												
												
											</p>

											<p class = "p2"> Member since {{date('M Y',strtotime($tprec->startdate))}}</p>
											
										</div>
									</div>

								</div>
							@endforeach
								

						</div>

					@endif


			
				</div>
		
			</div>
						
		</div>
					
	</div>



@include('home.directory_modal')

@stop