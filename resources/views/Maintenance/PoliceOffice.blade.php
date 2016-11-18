<html>
<head>
	<title>PO</title>
</head>

	<h1>Police Offices</h1>
	<form action="/buttonsPoliceOffice" method="POST">
		<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
		<label>Office Name</label>
		<input type="text" name="name">

		<label>Office Address</label>
		<input type="text" name="add">

		<label>Contact no</label>
		<input type="text" name="contact">

		<button type="submit" name="addbtn">Submit</button>
	</form>

	<form action="" method="POST">
		<table>
			<thead>
				<tr>
					<th>
						NAME
					</th>
					<th>
						Address
					</th>
					<th>
						Contact No
					</th>
				</tr>
			</thead>
				<tbody>
					@foreach($offices as $key => $res)
					<tr>
						<td>{{$res->officename}}</td>
						<td>{{$res->police_address}}</td>
						<td>{{$res->contactno}}</td>
						<td><a href="{{URL::to('maintenance/' .$res->ID. '/editpoliceview')}}" value="edit">EDIT</a></td>
					</tr>
					@endforeach
				</tbody>
		<table>
	</form>

</html>