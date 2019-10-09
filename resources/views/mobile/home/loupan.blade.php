<div class="box8 bg-white pdl15 pdr15 pdt20">
            <div class="mainPage-title mb10">
                <div class="left">热装楼盘</div>
                <a class="right block" href="/building">查看全部 <i class="iconfont icon-icon1"></i></a>
            </div>

            <div class="detail_team clearfix">
                                                            <a href="/building/101172" class="loupan">
                            <div class="img lazy">
                                <img data-original="http://img.dyrs.cc/store/969/094/000/26457341f6603b7b.jpg!zmm" src="//s.dyrs.cc/static/m/images/blank.gif"
                                    alt="西山壹号院楼盘装修" class="lazy_img auto">
                            </div>
                            <p class="ellipsis">西山壹号院</p>
                        </a>
                                                                                <a href="/building/105047" class="loupan">
                            <div class="img lazy">
                                <img data-original="http://img.dyrs.cc/store/730/629/000/6805b5a7f7bb522c.png!zmm" src="//s.dyrs.cc/static/m/images/blank.gif"
                                    alt="昆仑域楼盘装修" class="lazy_img auto">
                            </div>
                            <p class="ellipsis">昆仑域</p>
                        </a>
                                                                                <a href="/building/104703" class="loupan">
                            <div class="img lazy">
                                <img data-original="http://img.dyrs.cc/store/348/581/000/1725b0787b58a9d2.jpg!zmm" src="//s.dyrs.cc/static/m/images/blank.gif"
                                    alt="中国玺楼盘装修" class="lazy_img auto">
                            </div>
                            <p class="ellipsis">中国玺</p>
                        </a>
                                                </div>
            <form id="loupan" class="tabnav flex-box pr mt10" style="top:0;left:0" data-formvalidate="layer"
            	action="{{route('mobile.api.baojia.save')}}" method="post"
            	>
                <input type="hidden"  name="source" value="报名参观楼盘">
                <input type="text" class="yy_phone flex1 pdl10" placeholder="您的电话号码" validate="required|phone" maxlength="11" name="phone">
                <input type="submit" class="button button-primary yy_btn tc" value="报名参观楼盘" >
            </form>
            <script type="text/javascript">
                $(function () {
                	$("#loupan").ajaxForm(function (resp) {
                		alert("报名参观楼盘申请成功");
                	});
                })
            </script>
        </div>