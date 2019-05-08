<script type="text/javascript">
	function login2 (obj) {
		var form = $(obj).parents('form');

		var url = form.attr('action');
        var method = form.attr('method');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            dataType: "json",
            success: function(data){
				if(data["code"]=='1') {
					window.location.reload();					
				}else if (data["code"]=='99') {
					alert(data["msg"]);
				}
            }
       });
	}
</script>

<div id="_lottery_menu_head" class="new-header">
    <div name="hide" style="display: block;">
        <div class="bull" id="sys_tip_outer">
        	<span class="icon-acc"></span>
        	<!-- 这里是跑马灯<marquee>标签，由js加入dom  -->
    		<marquee id="sys_tip" behavior="scroll">公告：{{$_sysConfig->note}} </marquee></div>
    		
        @if (Auth::guard('member')->guest())
        <div id="header_user_login" style="display: block;">
        	<form action="{{ route('user.login') }}" method="post">
            <div class="lottery_login"><div class="top-login-bg"><i class="icon-6"></i>
            	<input class="top_loginip" name="username" placeholder="请输入用户名" type="text"></div>
            <div class="top-login-bg"><i class="icon-lock-icon"></i>
            	<input class="top_loginip" name="password" placeholder="请输入密码" type="password"></div>
                <input class="lottery_anniu" name="login" value="登录" type="button" onclick="login2(this)">
            </div>
            </form>
        </div>
        @else
        <div id="header_user" class="header-user" >
            <div class="user-name">账号：<span>{{ $_user->username }}</span></div>
            <div class="user-money">余额：<span>￥{{ $_user->money }}</span></div>
            <div class="money-btn" style="float: left;">
       			<a href="{{ route('home.recharge') }}">
       				<button class="recharge" style="width: 80px">充值/提现</button></a>
       			<a href="{{ route('user.logout') }}">
       				<button class="withdraw" style="">退出</button></a>
       		</div>
           	<div class="user-center"><ul>
           		<li ><a href="{{ route('user.game_result') }}"><i class="icon-7"></i>开奖记录</a></li>
           		<li ><a href="{{ route('user.game_record') }}"><i class="icon-3"></i>下注记录</a></li>
           		<li ><a href="{{ route('user.game_record_history') }}"><i class="icon-3"></i>下注历史</a></li>
           		</ul></div>
           		   
        </div>
        @endif
    </div>
</div>