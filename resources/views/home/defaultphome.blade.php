@extends('module.publichome')

@section('phomesection')

	<div class =  "dcon">
		<hr class="hr3">

		@if(sizeof($directory[0]) != 0)
			
					
			<h6 class="ui horizontal divider divtitle">
				Advisory Council
			</h6>

			<div id = "accardlist" class = "ui doubling grid cardlist2">

						@foreach($directory[0] as $acrec)

							<div class = "four wide column colheight">
								<div class = "cardstyleportrait">
									@if($acrec->imagepath != "")
										<img class = "advphoto1" src="{{URL::asset($acrec->imagepath)}}"/>
									@else
										<img class = "advphoto1" src="{{URL::asset('objects/Logo/InitProfile.png')}}"/>
									@endif
									<div class = "advdata1">
										<h5 class = "name">{{$acrec->lname}}, {{$acrec->fname}} {{$acrec->mname}} (AC)</h5>
										<p class = "p1">
											{{$acrec->acpositionname}} <br>

											@if($acrec->UnitOfficeQuaternaryName != "")
												{{$acrec->UnitOfficeQuaternaryName}}

												@if($acrec->UnitOfficeTertiaryName != "")
													,&nbsp;
												@endif

											@endif

											@if($acrec->UnitOfficeTertiaryName != "")
												{{$acrec->UnitOfficeTertiaryName}},&nbsp;

												@if($acrec->UnitOfficeQuaternaryName != "")
													<br>
												@endif

											@endif

											{{$acrec->UnitOfficeSecondaryName}} <br>
											
											
											
										</p>

										<p class = "p3"> Member since {{date('M Y',strtotime($acrec->startdate))}} &nbsp;&nbsp;</p>
										
									</div>
								</div>

							</div>
						@endforeach

			</div>
		@endif

			<br>
		
		@if(sizeof($directory[1]) != 0)
			<h4 class="ui horizontal divider divtitle">
				TWG & PSMU
			</h4>

			<div id = "tpcardlist" class = "ui doubling grid cardlist2">

						@foreach($directory[1] as $tprec)
							<div class = "four wide column colheight1">
								<div class = "cardstyleportrait">
									@if($tprec->imagepath != "")
										<img class = "advphoto1" src="{{URL::asset($tprec->imagepath)}}"/>
									@else
										<img class = "advphoto1" src="{{URL::asset('objects/Logo/InitProfile.png')}}"/>
									@endif
									<div class = "advdata1">
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

												@if($tprec->UnitOfficeTertiaryName != "")
													,&nbsp;
												@endif

											@endif

											@if($tprec->UnitOfficeTertiaryName != "")
												{{$tprec->UnitOfficeTertiaryName}},&nbsp;

												@if($tprec->UnitOfficeQuaternaryName != "")
													<br>
												@endif
											@endif

											{{$tprec->UnitOfficeSecondaryName}} <br>

											
										</p>

										<p class = "p3"> Member since {{date('M Y',strtotime($tprec->startdate))}} &nbsp;&nbsp;</p>
										
									</div>
								</div>

							</div>
						@endforeach
							

			</div>
		@endif
		
			
	</div>


@stop