@extends('baseform')

	@section('maincontent')

	<div class = "advcon">
		<div class = "btncon">
			<div class = "ui grid">
				<div class = "row">
					<div class = "five wide column moveright">
						<div class = "ui icon addbtn button tiny" 
							onclick = "window.location='{{url('directory/add')}}'" 
							title = "add">
							<i class="plus icon topmargin"></i>
							
						</div>
						<div class="ui icon addbtn dropdown button  tiny topmargin" title = "filter list">
							<i class="filter icon"></i>
							<div class="menu">
							    <div class="item" onclick ="window.location='{{url('directory/filter?f=0')}}'">
							    	Name
							    </div>
							    <div class = "divider"></div>
							    <div class="header">
						      		Date Created
						    	</div>
						    	<div class = "divider"></div>
						    	<div class="item"  onclick ="window.location='{{url('directory/filter?f=1')}}'">
							     	Ascending
							    </div>
							    <div class="item"  onclick ="window.location='{{url('directory/filter?f=2')}}'">
							    	Descending
							    </div>


						  </div>
						</div>

						<div class="ui icon input topmargin">
							<i class="search icon"></i>
							<input type="text" placeholder="Search...">
						</div>
					</div>
					
				</div>
			</div>

			
		</div>

		<div class = "advcardcon">
			<hr class="hr4">

			
			<div class = "itemlist">

					@if(sizeof($directory[0]) != 0)
						<h6 class="ui horizontal divider divtitle">
							Advisory Council
						</h6>

						<div id = "accardlist" class = "ui doubling grid cardlist2">

							@foreach($directory[0] as $acrec)
								<div class = "four wide column colheight">
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
					@endif
						<br>

					@if(sizeof($directory[1]) != 0)
						<h4 class="ui horizontal divider divtitle">
							TWG & PSMU
						</h4>

						<div id = "tpcardlist" class = "ui doubling grid cardlist2">

							@foreach($directory[1] as $tprec)
								<div class = "four wide column colheight">
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

	<script type="text/javascript">
		$('#tab3').attr('class', 'mlink item active');

	</script>

@include('home.directory_modal')

@stop