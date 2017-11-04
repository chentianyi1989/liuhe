<?php
?>

@extends('home.main')

@section('content')

<div class="L_HK6 P_tm skin_red lhc_center">
    <div id="main">
    	<table class="table_ball">
			<thead>
				<tr>
					<th>期数</th>
					<th>单号</th>
					<th>特码</th>
					<th>平码</th>
					<th>时间</th>
				<tr>
			</thead>
			<tbody>
				@foreach($gameRecord as $gr)
					<tr>
						<td>{{ $gr->code }}</td>
						<td>{{ $gr->id }}</td>
						<td>
							<?php 
							     $temas = json_decode($gr->tema);
							?>
							<table>
								<tr>
									<th>号码</th><th>生肖</th><th>金额</th>
								</tr>
								@foreach($temas as $tema)
								<tr>
									<td>{{$tema->code}}</td>
									<td>{{$tema->sx}}</td>
									<td>{{$tema->money}}</td>
								</tr>
								@endforeach
							</table>
							
						</td>
						<td>{{ $gr->pingma }}</td>
						<td>{{ $gr->created_at }}</td>
					</tr>
				@endforeach
			</tbody>
			
		</table>
    	{{$gameRecord->links()}}
    </div>
</div>

@endsection


