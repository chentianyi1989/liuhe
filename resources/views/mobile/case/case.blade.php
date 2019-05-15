<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="wap-font-scale" content="no">
<meta name="viewport"
	content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title>北京别墅装修公司-东易日盛原创国际</title>
<meta name="keywords" content="别墅装修,北京别墅装修,北京别墅装修公司,北京别墅装饰,别墅室内设计">
<meta name="description"
	content="东易日盛集团高端豪宅装饰品牌—原创国际别墅设计，专为别墅客户提供优质室内装修设计服务。贵宾专线：400-9999-162.">



<script src="//t.dyrs.cc/static/m/scripts/init.js?20181030"></script>
<link rel="stylesheet"
	href="//t.dyrs.cc/static/m/styles/vendor.css?20181030">
<link rel="stylesheet"
	href="//t.dyrs.cc/static/m/styles/yuanchuang/main.css?20181030">
<!-- <script type="text/javascript" src="http://pv.dyrs.com.cn/js/staticdata.js"></script> -->
<link rel="canonical" href="//ycgj.dyrs.com.cn" />
<link rel="stylesheet"
	href="//t.dyrs.cc/static/m/styles/yuanchuang/style1.css?20181030">

<script type="text/javascript" src="{{asset('/plugin/jquery.min.js')}}"></script>



<link rel="stylesheet" href="/css/case/vendor.css">
<link rel="stylesheet" href="/css/case/main.css">
<link rel="canonical" href="http://www.dyrs.com.cn/case/134444">

<link rel="stylesheet" href="/css/case/style2.css">
<link href="/css/case/jquery.css" rel="stylesheet">



</head>
<body>

	@include('mobile.header')
	
	<div class="container caseMsg" id="wrapper">
		<div class="topimg lazy load-over">
			<img class="lazy_img auto pa load-over"
				data-original="http://artwork.dyrs.cc/photo/541/248/000/4525bbd999145fb9.jpg!hml"
				src="http://artwork.dyrs.cc/photo/541/248/000/4525bbd999145fb9.jpg!hml"
				alt="鸿园现代简约风格260㎡别墅"
				style="display: block; width: 100%; height: auto; top: -0.044484%; left: 0px;">
			<div class="text">
				<!-- <div class="title">鸿园现代简约风格260㎡别墅</div> -->
				<h1 class="title">{{ @$case->title }}</h1>
				<div class="sub">
					<a href="http://m.dyrs.com.cn/case/ht1">{{ @$case->fengge_name }}</a> 
					<a href="http://m.dyrs.com.cn/case/s2">{{ @$case->leixing_name }}</a> 
					<a href="http://m.dyrs.com.cn/case/ha3">{{ @$case->mianji }}</a>
				</div>
			</div>
			<!-- 
			<div class="opration">
				<div>
					<i collect-id="134444" collect-status="no"
						class="iconfont icon-xin"
						onclick="page.setCollect('134444','case',this)"></i>
				</div>
				<div class="share" onclick="page.openShare()">
					<i class="iconfont icon-fenxiang-copy"></i>
				</div>
			</div> -->
		</div>
		
		<div class="pr bg-white pdb30 border-bottom">
			<div class="tab-design">
				<div class="designer">
					<div class="photo lazy load-over">
						<a href="http://m.dyrs.com.cn/designer/2366" rel="nofollow"><img
							class="lazy_img auto pa load-over"
							src="/resources/s1.jpg"
							alt="装修设计师宋辉"
							style="display: block; width: 100%; height: auto; top: 0%; left: 0px;"></a>
					</div>
					<div class="text">
						<div class="title text-black ellipsis">
							<a href="" url="http://m.dyrs.com.cn/designer/2366">邵婷</a>
						</div>
						<div class="sub">设计师总监</div>
					</div>
<!-- 					<button class="button button-primary" -->
<!-- 						onclick="page.yuyueLayer('预约设计师','action=design&amp;desc=预约设计师-设计师姓名-宋辉(2366)')">找TA设计</button> -->
				</div>
			</div>

			<div class="detail-title ml15 mr15">设计理念</div>

			<div class="common-detail-box pdb15 pr">
				<div class="common-detail pdl10 pdr10">
					{{@$case->shejilinian}}
				</div>
				<div class="common-detail-flag" data-detailtext="">
					<i class="iconfont icon-down-trangle-copy-copy"></i>
				</div>
			</div>
			<div style="height: 15px; background: #f7f7f7"></div>
			<div class="detail-title ml15 mr15">户型图</div>
			<div class="swiper-container swiper-container-horizontal">
				<div class="swiper-wrapper"
					style="transform: translate3d(0px, 0px, 0px);">
					<div class="swiper-slide swiper-slide-active" style="width: 750px;">
						<div class="detail-text-img">
							<div class="img">
							<?php 
							 $huxingtu = json_decode($case->huxingtu,true); 
							?>
						
								<img class="lazy_img load-over"
									src="{{@$huxingtu['url']}}"
									alt="{{@$huxingtu['name']}}" style="display: inline;">
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-button-prev swiper-button-disabled" tabindex="0"
					role="button" aria-label="Previous slide" aria-disabled="true">
					<i class="iconfont icon-xiayiye-copy"></i>
				</div>
				<div class="swiper-button-next" tabindex="0" role="button"
					aria-label="Next slide" aria-disabled="false">
					<i class="iconfont icon-xiayiye"></i>
				</div>
				<span class="swiper-notification" aria-live="assertive"
					aria-atomic="true"></span>
			</div>

			<div class="detail-title ml15 mr15">客厅</div>
			<div class="detail-text-img">
				<?php 
				    @$keting = json_decode($case->keting,true); 
				?>
		
				<div class="img">
					<a class=""
						href="{{@$keting['url']}}"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img load-over"
						src="{{@$keting['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$keting['name']}}</p>
			</div>
			<div class="detail-title ml15 mr15">卧室</div>
			<div class="detail-text-img">
				<div class="img">
					<?php 
					   @$woshi = json_decode($case->woshi,true);
					?>
					<a class=""
						href="http://artwork.dyrs.cc/photo/535/248/000/5945bbd9975bf1bb.jpg!sxl"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img load-over"
						src="{{@$woshi['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$woshi['name']}}</p>
			</div>
			@if ($case->canting)
			<div class="detail-title ml15 mr15">餐厅</div>
			<div class="detail-text-img">
				<div class="img">
					<?php 
					   @$canting = json_decode($case->canting,true);
					?>
					<a class=""
						href="http://artwork.dyrs.cc/photo/538/248/000/8815bbd9984233a4.jpg!sxl"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img
						class="lazy_img load-over"
						src="{{@$canting['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$canting['name']}}</p>
			</div>
			@endif
			@if ($case->chufang)
			<div class="detail-title ml15 mr15">厨房</div>
			<div class="detail-text-img">
				<div class="img">
					<?php 
					@$chufang = json_decode($case->chufang,true);
					?>
					<a class=""
						href="http://artwork.dyrs.cc/photo/539/248/000/6955bbd99883a97b.jpg!sxl"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img load-over"
						src="{{@$canting['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$canting['name']}}</p>
			</div>
			@endif
			@if ($case->xunguan)
			<div class="detail-title ml15 mr15">玄关</div>
			<div class="detail-text-img">
			<?php 
			@$xunguan = json_decode($case->xunguan,true);
			?>
				<div class="img">
					<a class=""
						href="http://artwork.dyrs.cc/photo/542/248/000/75bbd9995d3558.jpg!sxl"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img load-over"
						src="{{@$xunguan['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$xunguan['name']}}</p>
			</div>
			@endif
			@if ($case->qita)
			<div class="detail-title ml15 mr15">其他</div>
			<div class="detail-text-img">
			<?php 
			@$qita = json_decode($case->qita,true);
			?>
				<div class="img">
					<a class=""
						href="http://artwork.dyrs.cc/photo/530/248/000/7825bbd9960924e1.jpg!sxl"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img"
						src="{{@$qita['url']}}"
						alt="{{@$case->title}}">
					</a>
				</div>
				<p>{{@$qita['name']}}</p>
			</div>
			@endif
			<div class="company-address">
				<a class="div block" href="http://m.dyrs.com.cn/store/100054">
					<div class="content">
						<div class="cicle lazy">
							<img class="lazy_img auto"
								data-original="http://img.dyrs.cc/store/188/862/000/9935cb577a938698.jpg!zs"
								src="http://img.dyrs.cc/store/188/862/000/9935cb577a938698.jpg!zs"
								alt="原创国际别墅设计中心">
						</div>
						<div class="text ellipsis">原创国际别墅设计中心</div>
						<i class="iconfont icon-icon1"></i>
					</div>
				</a>
			</div>
		</div>

		<div class="change-detail2">
			<a class="btn" href="http://m.dyrs.com.cn/case/134443"
				title="天润尚院330平米新中式风格装修效果图">上一套案例</a> <a class="btn"
				href="http://m.dyrs.com.cn/case/134445" title="大河宸章380平现代港式风格装修效果图">下一套案例</a>

		</div>

	</div>



	@include('mobile.footer')
</body>
</html>