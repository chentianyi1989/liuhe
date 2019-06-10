@extends("mobile.main") 

@section('content')

<link href="{{asset('/m/info/css/style3.css')}}" rel="stylesheet" type="text/css" />

<div class="ttxq_box">
	<div class="container moban-page tt_info" id="wrapper">
		<div class="f15 text-black tc">
			<h1>{{@$bean->title}}</h1>
		</div>
		<div class="f12 text-color9 tc mt8">发布时间：{{@$bean->created_at}}</div>

		<div class="gz_info_box mt15 text-sub">
			<?php echo @$bean->content?>
		</div>
	</div>





	<!-- 广告 -->
	<div data-posid="194" id="js-show-ad" class="mt20">
		<a href="http://m.dyrs.com.cn/special/20190527/109787" target="_blank"><img
			src="http://m.dyrs.com.cn/special/20190527/109787"
			style="width: 100%"></a>
	</div>

	<div class="pd15">
		<div class="zx_list_title flex-box flex-between middle-a-end pdb10">
			<span class="f18 text-black">热门推荐</span> <span class="f14"><a
				href="http://m.dyrs.com.cn/column/13">查看更多 <i
					class="iconfont icon-icon1"></i></a></span>
		</div>
		
		<div class="item_box">
			<a href="http://m.dyrs.com.cn/story/201902/1074666" rel="nofollow">
				<div class="zx_item flex-box flex-box">
					<div class="img lazy mr15 mt10">
						<img
							data-original="http://img.dyrs.cc/store/978/813/000/4585c6cf33e278cc.jpg!zs"
							src="2018%E5%85%A8%E5%9B%BD%E6%8E%92%E5%90%8D%E8%BE%83%E5%A5%BD%E7%9A%84%E5%AE%B6%E8%A3%85%E5%85%AC%E5%8F%B8%E6%9C%89%E5%93%AA%E4%BA%9B,%E5%8D%81%E5%A4%A7%E8%A3%85%E4%BF%AE%E5%85%AC%E5%8F%B8%E6%8E%A8%E8%8D%90_%E8%A3%85%E4%BF%AE%E6%8C%87%E5%8D%97-%E4%B8%9C%E6%98%93%E6%97%A5%E7%9B%9B%E8%A3%85%E9%A5%B0_files/blank.gif"
							class="lazy_img auto" alt="2018全国排名较好的家装公司有哪些,十大装修公司推荐">
					</div>
					<div class="designer_list_words flex1 pdt10 pdb10">
						<p class="f15 ellipsis text-black mb6">2018全国排名较好的家装公司有哪些,十大装修公司推荐</p>
						<p class="f12 ellipsis mb2">​昨天元宵之夜的故宫不知道你是否去看了
						
							反正小编是没约到票。正月十五一过，意味着2019年正真来临了。不论是过去的2018年还是正在井进行的2019年，房子始终都是人们关注的话题。今天
							全国排名较好的家装公司东易日盛就为大家总结推荐2018年全国排名较好的家装公司有哪些。以下内容仅供大家参考选择</p>
						<div class="f12 ellipsis">发布时间：2019-02-20</div>
					</div>
				</div>
			</a> <a href="http://m.dyrs.com.cn/story/201801/1037733"
				rel="nofollow">
				<div class="zx_item flex-box flex-box">
					<div class="img lazy mr15 mt10">
						<img
							data-original="http://img.dyrs.cc/store/607/492/000/9845a5c076ea851a.jpg!zs"
							src="2018%E5%85%A8%E5%9B%BD%E6%8E%92%E5%90%8D%E8%BE%83%E5%A5%BD%E7%9A%84%E5%AE%B6%E8%A3%85%E5%85%AC%E5%8F%B8%E6%9C%89%E5%93%AA%E4%BA%9B,%E5%8D%81%E5%A4%A7%E8%A3%85%E4%BF%AE%E5%85%AC%E5%8F%B8%E6%8E%A8%E8%8D%90_%E8%A3%85%E4%BF%AE%E6%8C%87%E5%8D%97-%E4%B8%9C%E6%98%93%E6%97%A5%E7%9B%9B%E8%A3%85%E9%A5%B0_files/blank.gif"
							class="lazy_img auto" alt="2018年哪些家装品牌值得选择？">
					</div>
					<div class="designer_list_words flex1 pdt10 pdb10">
						<p class="f15 ellipsis text-black mb6">2018年哪些家装品牌值得选择？</p>
						<p class="f12 ellipsis mb2">​在过去一年，新零售、整装、全屋定制、大
							家居、智能家居成为热点，行业洗牌不断加速。进入2018年，家居市场又会出现哪些新的热点，家居企业又会在哪些方面着重发力，做出什么样的转型升级。今
							天来看他们对于行业做出哪些预测和企业有哪些转型和发展方向，我们来看2018年哪些家装品牌值得选择。</p>
						<div class="f12 ellipsis">发布时间：2018-01-15</div>
					</div>
				</div>
			</a>
		</div>

	</div>
</div>

@endsection

@section('mate.js')

@endsection
