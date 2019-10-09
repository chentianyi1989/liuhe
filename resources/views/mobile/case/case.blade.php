@extends("mobile.main") 

@section('content')

	
	<div class="container caseMsg" id="wrapper">
		<div class="topimg lazy load-over">
			<?php 
					 $huxingtu = json_decode($case->huxingtu,true); 
			?>
			<img class="lazy_img auto pa load-over"
				src="{{@$huxingtu['url']}}"
				alt="{{@$huxingtu['name']}}"
				style="display: block; width: 100%; height: auto; top: -0.044484%; left: 0px;">
			<div class="text">
				<!-- <div class="title">鸿园现代简约风格260㎡别墅</div> -->
				<h1 class="title">{{ @$case->title }}</h1>
				<div class="sub">
					<a href="">{{ @$case->fengge_name }}</a> 
					<a href="">{{ @$case->leixing_name }}</a> 
					<a href="">{{ @$case->mianji }}</a>
				</div>
			</div>
		</div>
		
		<div class="pr bg-white pdb30 border-bottom">
			<div class="tab-design">
				<div class="designer">
					<div class="photo lazy load-over">
						<a href="" rel="nofollow"><img
							class="lazy_img auto pa load-over"
							src="/resources/s1.jpg"
							alt="装修设计师宋辉"
							style="display: block; width: 100%; height: auto; top: 0%; left: 0px;"></a>
					</div>
					<div class="text">
						<div class="title text-black ellipsis">
							<a href="" url="">邵婷</a>
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
<!-- 			<div class="swiper-container swiper-container-horizontal"> -->
<!-- 				<div class="swiper-wrapper" -->
<!-- 					style="transform: translate3d(0px, 0px, 0px);"> -->
<!--					<div class="swiper-slide swiper-slide-active" style="width: 750px;">-->
<!-- 						<div class="detail-text-img"> -->
<!-- 							<div class="img"> -->
<!-- 								<img class="lazy_img load-over" -->
<!-- 									src="{{@$huxingtu['url']}}" -->
<!-- 									alt="{{@$huxingtu['name']}}" style="display: inline;"> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- 				<div class="swiper-button-prev swiper-button-disabled" tabindex="0" -->
<!-- 					role="button" aria-label="Previous slide" aria-disabled="true"> -->
<!-- 					<i class="iconfont icon-xiayiye-copy"></i> -->
<!-- 				</div> -->
<!-- 				<div class="swiper-button-next" tabindex="0" role="button" -->
<!-- 					aria-label="Next slide" aria-disabled="false"> -->
<!-- 					<i class="iconfont icon-xiayiye"></i> -->
<!-- 				</div> -->
<!-- 				<span class="swiper-notification" aria-live="assertive" -->
<!-- 					aria-atomic="true"></span> -->
<!-- 			</div> -->


			<div class="detail-title ml15 mr15">户型图</div>
			<div class="detail-text-img">
		
				<div class="img">
					<a class=""
						href="{{@$huxingtu['url']}}"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img load-over"
						src="{{@$huxingtu['url']}}"
						alt="{{@$case->title}}" style="display: inline;">
					</a>
				</div>
				<p>{{@$huxingtu['name']}}</p>
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
						href="{{@$woshi['url']}}"
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
						href="{{@$canting['url']}}"
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
						href="{{@$canting['url']}}"
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
						href="{{@$xunguan['url']}}"
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
						href="{{@$qita['url']}}"
						data-fancybox="gallery" rel="a1" title="{{@$case->title}}"> 
						<img class="lazy_img"
						src="{{@$qita['url']}}"
						alt="{{@$case->title}}">
					</a>
				</div>
				<p>{{@$qita['name']}}</p>
			</div>
			@endif

	</div>

@endsection

@section('mate.js')

@endsection