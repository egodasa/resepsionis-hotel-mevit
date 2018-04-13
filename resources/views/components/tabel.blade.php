<table>
	<tr>
		<th>No</th>
		@foreach($fields as $r)
		<th>{{$r['title']}}</th>
		@endforeach
	</tr>
	@foreach($data as $d)
		<tr>
			<td>{{$loop->iteration}}</td>
			@foreach($fields as $r)
			<td>{{$d[$r['name']]}}</td>
			@endforeach
		</tr>
	@endforeach
</table>
	
