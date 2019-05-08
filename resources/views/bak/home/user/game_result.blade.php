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
					<th>时间</th>
				<tr>
			</thead>
			<tbody>
			
				@foreach($gameResult as $gr)
					<tr>
						<td>{{ $gr->code }}</td>
						<td>
							@foreach($gr->pingma_result as $r)
                            	<span class="col-{{ $r }}">{{$r}}</span> 
                            @endforeach
                        + <span class="col-{{$gr->tema_result}}">{{$gr->tema_result}}</span>
							
						</td>
						<td>{{ $gr->lottery_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
    	{{ $gameResult->links() }}
    </div>
</div>

@endsection


