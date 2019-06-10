@extends("mobile.main") @section('content')

<div class="container moban-page f12 bg-white pdt20" id="zxq_index">
	<div class="tabbox flex-box flex-between text-sub">
		
		@foreach (@config("sys.inform_fenlei")[$dalei]["child"] as $k => $v) 
		<div class="btn flex1 tc f15 @if ($k==$xiaolei)active @endif">
			<a href="{{route('mobile.info.list')}}?dalei={{@$dalei}}&xiaolei={{$k}}">{{$v}}</a>
		</div>
		@endforeach
	</div>
	<div class="mt16 zxq_list" id="story">
		<div class="item_box">
		
			@foreach ($beans as $item) 
			<a href="{{route('mobile.info.info',$item['id'])}}">
				<div class="zx_item flex-box flex-box">
					<div class="img lazy mr15 mt10 load-over">
						<img
							src="{{@$item->tuxiang}}"
							class="lazy_img auto load-over" alt="{{@$item->title}}"
							style="display: block; width: 100%; height: auto; top: 0%; left: 0px;">
					</div>
					<div class="designer_list_words flex1 pdt10 pdb10">
						<p class="f15 ellipsis text-black mb6">{{@$item->title}}</p>
						<p class="f12 ellipsis mb2">​{{@$item->content_title}}</p>
						<div class="f12 ellipsis">发布时间：{{@$item->created_at}}</div>
					</div>
				</div>
			</a>
			@endforeach  
		</div>
	</div>
<!-- 	<div id="loadState"></div> -->
</div>

@endsection
