@extends('welcome')

@section('content')

		<form method="POST" action="acpositioninsert">
		<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">
		ID:<input type="text" id="ID" value="" disabled/>
		Advisory Position:<input type="text" name="acpositionname" value=""/>
		<input type="submit" name="storeposition"/>
		</form>

		<div>Position</div>
		@foreach ($positions as $positions)
			<div>
			@unless (empty('positions'))
				<li style="color:red; font-weight: bold;">{{ $positions->acpositionname}}
				<input type="hidden" name="acpositionid" value="{{ $position->ID}}" /> 
				<input type="submit" name="editacposition" value="Edit"/>
				<input type="submit" name="deleteacposition" value="Delete"/>
				</li>
				
			@endunless
			</div>
		@endforeach
@stop