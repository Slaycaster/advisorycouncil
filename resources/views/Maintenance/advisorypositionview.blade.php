@extends('welcome')

@section('content')
 		
		
		<form method="POST" action="acpositioninsert">
		<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">
		ID:<input type="number" id="ID" value="" disabled/>
		Advisory Position:<input type="text" name="acpositionname" value=""/>
		<input type="submit" name="storeposition"/>
		<input type="submit" name="cancel" value="CANCEL"/>
		</form>

		<div>Position</div>
		<table border="1">
					<thead>
						<tr><div><th>Position Name</th></div>
						<div><th>Action</th></div>
						</tr>
					</thead>
					</tbody>
						@foreach ($positions as $positions)		
						<tr>
							<form method="POST" action="acpositionedit">
							<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">
							
							<td> 
							<label style="color:red; font-weight: bold;;">{{ $positions->acpositionname}}</label> 
							<input type="hidden" name="acpositionid" value="{{$positions->ID}}"/>
							</td>

							<td>
							<input type="submit" name="editacposition" value="Edit"/>
							<input type="submit" name="deleteacposition" value="Delete" onclick="alert('No Deleteion of Item')"/>
							</td>

							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
@stop