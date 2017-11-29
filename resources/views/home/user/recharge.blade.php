<?php
?>

@extends('home.main')

@section('content')

<div class="L_HK6 P_tm skin_red lhc_center">
    <div id="main">
    	<table class="table_ball">
			<thead>
				<tr>
					<th>操作</th>
					<th>金额</th>
					<th>时间</th>
				<tr>
			</thead>
			<tbody>
				@foreach($logMemberMoney as $gr)
					<tr>
<!-- 					<td>{{ $gr->id }}</td> -->
						<td>{{ $gr->info }}</td>
						<td>{{ $gr->money }}</td>
						<td>{{ $gr->created_at }}</td>
					</tr>
				@endforeach
			</tbody>
			
		</table>
    	{{$logMemberMoney->links()}}
    </div>
</div>

@endsection


