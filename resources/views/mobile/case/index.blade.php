@extends("mobile.main")


@section('content')

<div class="tabPage" data-tab="">
	<ul>
				<li data-check="city" data-default="全国" class="flex1 flex-box middle"><div class="ellipsis" style="max-width: 80%;">全国</div><i class="iconfont"></i></li>
						<li data-check="type" data-default="户型" class="flex1 flex-box middle"><div class="ellipsis" style="max-width: 80%;">户型</div><i class="iconfont"></i></li>
						<li data-check="style" data-default="风格" class="flex1 flex-box middle"><div class="ellipsis" style="max-width: 80%;">风格</div><i class="iconfont"></i></li>
						<li data-check="area" data-default="面积" class="flex1 flex-box middle"><div class="ellipsis" style="max-width: 80%;">面积</div><i class="iconfont"></i></li>
			</ul>
</div>

	
	
<div class="tabShow" data-tabpage="type">
	<a class="tabSpan black active" href="http://m.dyrs.com.cn/case">全部</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht1">别墅</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht3">跃层</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht4">普通住宅</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht5">会所</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht9">一居室</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht6">二居室</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht10">三居室</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht11">四居室</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht12">Loft</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ht8">复式</a>
</div>

<div class="tabShow" data-tabpage="style">
	<a class="tabSpan black active" href="http://m.dyrs.com.cn/case">全部</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s2">现代简约</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s1">欧式古典</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s7">新中式</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s34">法式</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s35">北欧</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s5">美式乡村</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s33">简欧</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s6">现代前卫</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s4">雅致主义</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s3">新古典</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s8">地中海式</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/s9">其他</a>
</div>

<div class="tabShow" data-tabpage="area">
	<a class="tabSpan black active" href="http://m.dyrs.com.cn/case">全部</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha1">120平米以下</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha2">121-180平米</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha3">181-320平米</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha4">321-500平米</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha5">501-1000平米</a>
	<a class="tabSpan black " href="http://m.dyrs.com.cn/case/ha6">1000平米以上</a>
</div>

<div class="container" id="wrapper">
<div id="case">
	@foreach ($cases as $case) 
		<?php 
		@$keting = json_decode($case->keting,true); 
    	?>
	<div class="anli lazy load-over">
		<a href="{{route('mobile.case.caseOne',[$case->id])}}" rel="nofollow" class="caseimg"> 
		<img class="lazy_img auto bgimg load-over"
			src="{{$keting['url']}}"
			alt="{{$case->title}}"
			style="display: block; width: auto; height: 100%;width:100%; top: 0px;">
			<div class="bgimg"></div>
		</a> 
		<!-- 
		<a class="designer" href="http://m.dyrs.com.cn/designer/2969"
			rel="nofollow">
			<div class="photo lazy load-over">
				<img class="lazy_img auto load-over"
					data-original="http://img.dyrs.cc/store/204/604/000/8115b2cac2d5c172.jpg!zs"
					src="http://img.dyrs.cc/store/204/604/000/8115b2cac2d5c172.jpg!zs"
					alt="装修设计师卢月"
					style="display: block; width: 100%; height: auto; top: 0%; left: 0px;">
			</div>
			<div class="name">卢月</div>
		</a> -->
		<div class="text">
			<div class="title ellipsis">{{ @$case->title }}</div>
			<div class="sub ellipsis">
				<a href="http://m.dyrs.com.cn/case/ht1">{{@$case->fengge_name}}</a> <a
					href="http://m.dyrs.com.cn/case/s1">{{@$case->leixing_name}}</a> <a
					href="http://m.dyrs.com.cn/case/ha4">{{@$case->mianji}}</a>

			</div>
		</div>
		<!-- 
		<div class="collect">
			<div>
				<a href="http://m.dyrs.com.cn/case/139883" rel="nofollow"
					class="caseimg"> <i class="iconfont icon-tupian"></i> 10
				</a>
			</div>
			<div>
				<i collect-id="139883" collect-status="no" class="iconfont icon-xin"
					onclick="page.setCollect('139883','case',this)"></i> <span
					class="collect_num">0</span>
			</div>
		</div> -->
	</div>
	@endforeach
</div></div>
@endsection