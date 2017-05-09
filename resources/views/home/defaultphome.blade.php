@extends('module.publichome')

@section('phomesection')

	<div class =  "dcon rwddcon">
		

		@if(sizeof($directory[0]) != 0)
			
					
			<h6 class="ui horizontal divider divtitle">
				Advisory Council
			</h6>

			<div class="infinite-scroll">
			<div id = "accardlist" class = "ui doubling grid cardlist2 rwdLcardlist2">

						@foreach($directory[0] as $acrec)

							<div class = "four wide column colheight ">
								<div class = "cardstyleportrait">
									@if($acrec->imagepath != "")
										<img class = "advphoto1" src="{{URL::asset($acrec->imagepath)}}"/>
									@else
										<img class = "advphoto1" src="{{URL::asset('objects/Logo/InitProfile.png')}}"/>
									@endif
									<div class = "advdata1">
										<h5 class = "name">{{$acrec->lname}}, {{$acrec->fname}} {{$acrec->mname}} (AC)

											@if($acrec->birthdate != "")
												@if($acrec->daysleft > 7 && $acrec->daysleft <= 14)
											
													<i class="ui green announcement icon" title = "Two (2) weeks before birthday"></i>
													
												@elseif($acrec->daysleft <= 7 && $acrec->daysleft > 0)
													<i class="ui green announcement icon" title = "{{$acrec->daysleft}} days before birthday"></i>
													
												@elseif($acrec->daysleft == 0)
													<i class="ui red birthday icon" title = "Happy Birthday!"></i>
												@endif
											@endif
										</h5>
										<p class = "p1">
											{{$acrec->acpositionname}} <br>

											@if($acrec->UnitOfficeQuaternaryName != "")
												{{$acrec->UnitOfficeQuaternaryName}},&nbsp;

											@endif

											@if($acrec->UnitOfficeTertiaryName != "")
												{{$acrec->UnitOfficeTertiaryName}},&nbsp;

												@if($acrec->UnitOfficeQuaternaryName != "")
													<br>
												@endif

											@endif

											{{$acrec->UnitOfficeSecondaryName}} <br>
											
											
											
										</p>

										@if($acrec->startdate != "")
											<p valign="bottom" class = "p2"> Member since {{date('d M Y',strtotime($acrec->startdate))}}</p>

										@endif
									</div>
								</div>

							</div>
						@endforeach
						{{ $directory[0]->links() }}

			</div>
			</div>
		@endif

			<br>
		
		@if(sizeof($directory[1]) != 0)
			<h6 class="ui horizontal divider divtitle">
				TWG & PSMU
			</h6>
			<div class="infinite-scroll">
			<div id = "tpcardlist" class = "ui doubling grid cardlist2 rwdDcardlist2">

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

											@if($tprec->birthdate != "")
													@if($tprec->daysleft > 7 && $tprec->daysleft <= 14)
												
														<i class="ui green announcement icon" title = "Two (2) weeks before birthday"></i>
														
													@elseif($tprec->daysleft <= 7 && $tprec->daysleft > 0)
														<i class="ui green announcement icon" title = "{{$acrec->daysleft}} days before birthday"></i>
														
													@elseif($tprec->daysleft == 0)
														<i class="ui red birthday icon" title = "Happy Birthday!"></i>
													@endif
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

										@if($tprec->startdate != "")
											<p valign="bottom" class = "p2"> Member since {{date('d M Y',strtotime($tprec->startdate))}}</p>

										@endif
									</div>
								</div>

							</div>
						@endforeach
						{{ $directory[1]->links() }}
							

			</div>
			</div>
		@endif
		
		
			
	</div>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src='{{ URL::asset("jscroll/jquery.jscroll.min.js") }}'></script>
		<script type="text/javascript">
		        $('ul.pagination').hide();
		        $(function() {
		            $('.infinite-scroll').jscroll({
		                autoTrigger: true,
		                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
		                padding: 0,
		                nextSelector: '.pagination li.active + li a',
		                contentSelector: 'div.infinite-scroll',
		                callback: function() {
		                    $('ul.pagination').remove();
		                }
		            });
		        });
		</script>

@stop