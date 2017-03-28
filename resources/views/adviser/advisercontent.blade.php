@extends('module.adviser')

@section('advisercontent')
	<div class = "advcardcon">
			
			<div class = "itemlist">

					@if(sizeof($directory[0]) != 0)
						<h6 class="ui horizontal divider divtitle">
							Advisory Council
						</h6>
						<div class="infinite-scroll">
						<div id = "accardlist" class = "ui doubling grid cardlist2">

							@foreach($directory[0] as $acrec)
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

												@if($acrec->email != "")
													{{$acrec->email}} <br>
												@endif

												

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
						<div id = "tpcardlist" class = "ui doubling grid cardlist2">

							@foreach($directory[1] as $tprec)
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

												

												@if($tprec->email != "")
													{{$tprec->email}} <br>
												@endif

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
							{{ $directory[1]->links() }}
								

						</div>

					</div>

					@endif
				
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