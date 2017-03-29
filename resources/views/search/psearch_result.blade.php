@extends('module.publichome')

@section('phomesection')

	<div class ="advcardcon">
		<div class="ui grid">
			<div class = "row">
				<div class = "sixteen wide column">
					<div class = "hcontent1">
						<div class="dcon">
							<div class = "tablepane">
								<div class = "mtitle">Results for "

									@if(isset($query))
										{{$query}}
									@endif


								"</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class = "row">
				<div class = "sixteen wide column">
					
					<div class = "itemlist">
						@if(count($data) == 0 && count($data2) == 0)
						<br>
						<h3 class="texttitle"><center>NO RECORD TO SHOW</center></h3>

						@else
						@if(count($data) != 0)
			
					
			<h6 class="ui horizontal divider divtitle">
				Advisory Council
			</h6>
			<div class="infinite-scroll">

			<div id = "accardlist" class = "ui doubling grid cardlist2">

						@foreach($data as $acrec)

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
										@if($acrec->daysleft > 7 && $acrec->daysleft <= 14)
										
										<p class = "p3" style="color:red;">2 Weeks before birthday</p>
										
										@elseif($acrec->daysleft <= 7 && $acrec->daysleft > 0)
										
										<p class = "p3" style="color:red;">{{$acrec->daysleft}} days before birthday</p>
										
										@elseif($acrec->daysleft == 0)
										<p class = "p3" style="color:red;">Happy Birthday!</p>
										
										@endif
									</div>
								</div>

							</div>
						@endforeach
						{{$data->links()}}

			</div>
		</div>
		@endif

			<br>
		
		@if(count($data2) != 0)
			<h6 class="ui horizontal divider divtitle">
				TWG & PSMU
			</h6>
			<div class="infinite-scroll">

			<div id = "tpcardlist" class = "ui doubling grid cardlist2">

						@foreach($data2 as $tprec)
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
										@if($tprec->daysleft > 7 && $tprec->daysleft <= 14)
										
										<p class = "p3" style="color:red;">2 Weeks before birthday</p>
										
										@elseif($tprec->daysleft <= 7 && $tprec->daysleft > 0)
										
										<p class = "p3" style="color:red;">{{$tprec->daysleft}} days before birthday</p>
										
										@elseif($tprec->daysleft == 0)
										<p class = "p3" style="color:red;">Happy Birthday!</p>

										@endif
									</div>
								</div>

							</div>
						@endforeach
						{{$data2->links()}}
							

			</div>
			</div>
						
		@endif
		@endif
						
					</div>
						
					
					
				</div>
			</div>
			
		</div>

		
		
	</div>

	<script type="text/javascript" src='{{ URL::asset("jscroll/jquery.jscroll.min.js") }}'></script>
		<script type="text/javascript">
				$('viewadv').modal('hide');
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