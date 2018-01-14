<script type="text/javascript">

function toggleQiShu (obj) {
	
	var i = $(obj).attr("index");
	var clazz = "tabulous_active";
	var qihao1 = $("#qihao1");
	var qihao2 = $("#qihao2");
	var tab1 = $("#gd-box1");
	var tab2 = $("#gd-box2");
	if (i == "1") {
		
		qihao1.addClass(clazz);
		qihao2.removeClass(clazz);
		tab1.css("display","block");
		tab2.css("display","none");
	}else {
		
		qihao1.removeClass(clazz);
		qihao2.addClass(clazz);
		tab1.css("display","none");
		tab2.css("display","block");
	}
}


$(function () {

// 	var time = 60*60*2;
// 	time = 5;
	countdownTime({{$nextOpenTime or "null"}});
	
});

//倒计时
function countdownTime(time) {
	if (time == "null") {
		return;
	}
    var $h1 = $('#count_down').find('span.leaveh-1'),
            $h2 = $('#count_down').find('span.leaveh-2'),
            $m1 = $('#count_down').find('span.leavem-1'),
            $m2 = $('#count_down').find('span.leavem-2'),
            $s1 = $('#count_down').find('span.leaves-1'),
            $s2 = $('#count_down').find('span.leaves-2');
    var t = time * 1000;
    var d, h, m, s;
    var end = new Date().getTime() + t;
    if (t > 0) {
        CDTime = setInterval(function () {
            t = end - new Date().getTime();
            d = Math.floor(t / (24 * 3600 * 1000));
            $("#lastTime").val(t);
            if (t > 0) {
                h = Math.floor(t /1000 / 60 / 60 % 24) + d * 24;
                // h = Math.floor(t / 1000 / 60 / 60 % 24);
                if (h < 10) {
                    // h = "0" + h;
                    $h1.text('0');
                    $h2.text(h);
                } else {
                    h = h + '';
                    $h1.text(h.substr(0, 1));
                    $h2.text(h.substr(1, 2));
                }
                m = Math.floor(t / 1000 / 60 % 60);
                if (m < 10) {
                    $m1.text('0');
                    $m2.text(m);
                } else {
                    m = m + '';
                    $m1.text(m.substr(0, 1));
                    $m2.text(m.substr(1, 2));
                }
                s = Math.floor(t / 1000 % 60);
                if (s < 10) {
                    $s1.text('0');
                    $s2.text(s);
                } else {
                    s = s + '';
                    $s1.text(s.substr(0, 1));
                    $s2.text(s.substr(1, 2));
                }
            } else {
                clearInterval(CDTime);
                window.location.reload();
            }
        }, 1000);
    }
}
</script>

<div class="gm_con_to" style="max-width:1040px;margin-left:auto;margin-right:auto;">
    <div style="margin-top:5px;" class="unit_title">
        <div class="ut_l"></div>
        <div class="ut_r"></div>
    </div>
    <div class="gct_l">
        <a href="{{ route('index') }}"><div class="game-icon1 game_sixlottery"></div></a>
        
        @if ($currGameResult) 
        	<p class="time-title">已开盘,欢迎投注。距离关盘还有</p>
            <div class="gct-time">
                <div class="gct-time-now">
                    <input id="lottory_open" value="true" type="hidden">
                    <div class="gct-time-now-l" id="count_down"> 
                    <span class="leaveh-1">0</span><span class="leaveh-2">0</span><span class="interval">:</span>
                    <span class="leavem-1">0</span><span class="leavem-2">0</span><span class="interval">:</span>
                    <span class="leaves-1">0</span><span class="leaves-2">0</span>
                    </div>
                </div>
            </div>
            <h3 name="page_name">{{$_sysConfig->title}}</h3>
        	<div class="gct_now"><strong>第&nbsp;&nbsp;<span id="current_issue" class="color-green">{{$currGameResult->code }}</span>&nbsp;&nbsp;期</strong></div>
        @else
        	<p class="time-title">未开盘,距离开盘还有</p>
            <div class="gct-time">
                <div class="gct-time-now">
                    <input id="lottory_open" value="true" type="hidden">
                    <div class="gct-time-now-l" id="count_down"> 
                    <span class="leaveh-1">0</span><span class="leaveh-2">0</span><span class="interval">:</span>
                    <span class="leavem-1">0</span><span class="leavem-2">0</span><span class="interval">:</span>
                    <span class="leaves-1">0</span><span class="leaves-2">0</span>
                    </div>
                </div>
            </div>
            <h3 name="page_name">{{$_sysConfig->title}}</h3>
        	<div class="gct_now"><strong><span id="current_issue" class="color-green">暂未未开盘</span></strong></div>	
        @endif
        
        <div class="clear"></div>
        <div class="gct_menu">
            <a class="gct_menu_yl" target="_blank"></a>
        </div>
    </div>
    <div id="showgd-box">
        <ul class="box-ul">
        	<li><a id="qihao1" index="1" onclick="toggleQiShu(this)" class="tabulous_active" >近一期</a></li>
			<li><a id="qihao2" index="2" onclick="toggleQiShu(this)">近五期</a></li>
		</ul>
        <div id="tabs_container" style="height:120px;">
            <div id="gd-box1" class="hideleft" style="position: absolute; top: 40px;">
            	
            	
            	
            	@for($i=0;$i<1;$i++)
            	    @if ($gameResult&&count($gameResult)>0) 
            		<?php  $gr = $gameResult[$i]; ?>
                    
                    <div id="gd-box1" class="showleft" style="position: absolute; top: 40px;">
                        <p>{{$_sysConfig->title}} 第&nbsp;&nbsp;
                            <b><span class="color-green">{{ $gr->code }}</span></b>&nbsp;&nbsp;期
                            <span id="lt_opentimebox2" style="color:#F9CE46;"><strong></strong></span>
                        </p>
                        <div class="menu1">
                            <a id="result_balls" class="T_HK6 L_HK6">
                            @foreach($gr->pingma_result as $r)
                            	<span><b class="b{{ $r }}"></b></span>
                             @endforeach
                            	<span class="plus">+</span>
                            	<span><b class="b{{$gr->tema_result}}"></b></span></a>
                        </div>
                    </div>
                    @endif
            	@endfor
            </div>
            
            <div id="gd-box2" class="hideleft" style="position: absolute; top: 40px;display: none" >
            	
            	@foreach($gameResult as $gr)
                	<p>第 <span class="col-r">{{ $gr->code }}</span> 期:&nbsp;&nbsp;  
                		@foreach($gr->pingma_result as $r)
                        	<span class="col-{{ $r }}">{{$r}}</span> 
                        @endforeach
                        + <span class="col-{{$gr->tema_result}}">{{$gr->tema_result}}</span>
                    </p>
                
                @endforeach
            </div>
        </div>
        <!--End tabs container-->
    </div>
    <div class="clear"></div>
</div>