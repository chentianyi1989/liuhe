@extends("mobile.main") 

@section('content')

	
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
<!-- 			<div class="company-address"> -->
<!-- 				<a class="div block" href="http://m.dyrs.com.cn/store/100054"> -->
<!-- 					<div class="content"> -->
<!-- 						<div class="cicle lazy"> -->
<!-- 							<img class="lazy_img auto" -->
<!-- 								src="http://img.dyrs.cc/store/188/862/000/9935cb577a938698.jpg!zs" -->
<!-- 								alt="原创国际别墅设计中心"> -->
<!-- 						</div> -->
<!-- 						<div class="text ellipsis">原创国际别墅设计中心</div> -->
<!-- 						<i class="iconfont icon-icon1"></i> -->
<!-- 					</div> -->
<!-- 				</a> -->
<!-- 			</div> -->
		</div>

<!-- 		<div class="change-detail2"> -->
<!-- 			<a class="btn" href="http://m.dyrs.com.cn/case/134443" -->
<!-- 				title="天润尚院330平米新中式风格装修效果图">上一套案例</a> <a class="btn" -->
<!-- 				href="http://m.dyrs.com.cn/case/134445" title="大河宸章380平现代港式风格装修效果图">下一套案例</a> -->
<!-- 		</div> -->

	</div>

@endsection

@section('mate.js')

@endsection