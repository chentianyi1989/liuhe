<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>首页</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	
	
	<link rel="stylesheet" type="text/css" href="{{ asset('/plugin/easyui/ui/themes/icon.css') }}"/>													 
	<link rel="stylesheet" type="text/css" href="{{ asset('/plugin/easyui/ui/themes/default/easyui.css') }}">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('/plugin/easyui/default.css') }}" />
	
	<script type="text/javascript" src="{{ asset('/plugin/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/plugin/easyui/inti.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/plugin/easyui/ui/jquery.easyui.min.js') }}"></script>
	
	<script type="text/javascript">
		var _menus = {"menus":[
			{"menuid":"3","icon":"icon-sys","menuname":"游戏管理",
				"menus":[
					{"menuname":"游戏监控","icon":"icon-nav","url":"{{ route('game.info') }}"},
					{"menuname":"下注监控","icon":"icon-nav","url":"{{ route('game.betInfo') }}"},
					{"menuname":"游戏结果记录","icon":"icon-nav","url":"{{ route('game.gameResult') }}"},
// 					{"menuname":"游戏设置","icon":"icon-nav","url":"{{ route('game.game') }}"},
// 			        {"menuname":"号码设置","icon":"icon-nav","url":"{{ route('game.ball') }}"},
			        {"menuname":"系统设置","icon":"icon-nav","url":"{{ route('game.game.sysConfig') }}"},
				]
			},
// 			{"menuid":"1","icon":"icon-sys","menuname":"系统管理",
// 				"menus":[
// 			        {"menuname":"管理员设置","icon":"icon-nav","url":"#{$ctx}/admin/user/user.php"},
			        
// 				]
// 			},
			{"menuid":"2","icon":"icon-sys","menuname":"用户管理",
				"menus":[
			        {"menuname":"用户列表","icon":"icon-nav","url":"{{ route('members.member') }}"},
			        {"menuname":"游戏记录","icon":"icon-nav","url":"{{ route('members.gameRecord') }}"},
			        {"menuname":"账户记录","icon":"icon-nav","url":"{{ route('members.logMoney') }}"},
			        {"menuname":"登陆日志","icon":"icon-nav","url":"{{ route('members.loginLog') }}"},
				]
			}
// 			,{"menuid":"3","icon":"icon-sys","menuname":"财务管理",
// 				"menus":[
// 			        {"menuname":"赔率设置","icon":"icon-nav","url":"#{$ctx}/business/workflow!myTask.do"},
// 			        {"menuname":"赔率设置","icon":"icon-nav","url":"#{$ctx}/business/workflow!myTask.do"},
// 				]
// 			}
		]};
        //设置登录窗口
        function openPwd() {
            $('#w').window({
                title: '修改密码',
                width: 300,
                modal: true,
                shadow: true,
                closed: true,
                height: 160,
                resizable:false
            });
        }
        //关闭登录窗口
        function closePwd() {
            $('#w').window('close');
        }
        //修改密码
        function serverLogin() {
            var $newpass = $('#txtNewPass');
            var $rePass = $('#txtRePass');

            if ($newpass.val() == '') {
                msgShow('系统提示', '请输入密码！', 'warning');
                return false;
            }
            if ($rePass.val() == '') {
                msgShow('系统提示', '请在一次输入密码！', 'warning');
                return false;
            }

            if ($newpass.val() != $rePass.val()) {
                msgShow('系统提示', '两次密码不一至！请重新输入', 'warning');
                return false;
            }

            $.post('/ajax/editpassword.ashx?newpass=' + $newpass.val(), function(msg) {
                msgShow('系统提示', '恭喜，密码修改成功！<br>您的新密码为：' + msg, 'info');
                $newpass.val('');
                $rePass.val('');
                close();
            });
            
        }

        $(function() {

            openPwd();
            //
            $('#editpass').click(function() {
                $('#w').window('open');
            });

            $('#btnEp').click(function() {
                serverLogin();
            });

			$('#btnCancel').click(function(){closePwd();})

            $('#loginOut').click(function() {
                $.messager.confirm('系统提示', '您确定要退出本次登录吗?', function(r) {

                    if (r) {
                        location.href = '{{ route("login.logout") }}';
                    }
                });

            });
        });
    </script>
	
</head>
<body class="easyui-layout" style="overflow-y: hidden"  scroll="no">

<noscript>
<div style=" position:absolute; z-index:100000; height:2046px;top:0px;left:0px; width:100%; background:white; text-align:center;">
    <img src="images/noscript.gif" alt='抱歉，请开启脚本支持！' />
</div></noscript>

<!-- 顶部区域 -->
<div region="north" split="true" border="false" style="overflow: hidden; height: 30px;">
	<div class="head">
		
		<span style="padding-left:10px; font-size: 16px;float: left; ">
    		香港龙凤彩后台
    	</span>
    	
		<span style="padding-right:20px;float: right;" >
        	欢迎 {{$user->username }}
<!--     	    <a href="#" id="editpass">修改密码</a>  -->
    	    <a href="#" id="loginOut">安全退出</a>
    	</span>
        
	</div>
    
</div>
<!-- 底部区域 -->
<div region="south" split="true" style="height: 30px; background: #D2E0F2; ">
    <div class="footer">8888889999.com</div>
</div>

<!-- 左边 菜单区域 -->
<div region="west" split="true" title="导航菜单" style="width:180px;" id="west">
	<div class="easyui-accordion" fit="true" border="false">
		<!--  导航内容 -->
	</div>
</div>

<!-- 主工作区间 -->
<div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">
    <div id="tabs" class="easyui-tabs"  fit="true" border="false"  data-options="tools:'#tab-tools'">
		<div title="欢迎使用" style="padding:20px;overflow:hidden;" id="home">
		</div>
	</div>
</div>
  
<div id="tab-tools">
	<a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-save'" onclick="javascript:refresh()"></a>
</div>    
    
    <!--修改密码窗口-->
    <div id="w" class="easyui-window" title="修改密码" collapsible="false" minimizable="false"
        maximizable="false" icon="icon-save"  style="width: 300px; height: 150px; padding: 5px;
        background: #fafafa;">
        <div class="easyui-layout" fit="true">
            <div region="center" border="false" style="padding: 10px; background: #fff; border: 1px solid #ccc;">
                <table cellpadding=3>
                    <tr>
                        <td>新密码：</td>
                        <td><input id="txtNewPass" type="Password" class="txt01" /></td>
                    </tr>
                    <tr>
                        <td>确认密码：</td>
                        <td><input id="txtRePass" type="Password" class="txt01" /></td>
                    </tr>
                </table>
            </div>
            <div region="south" border="false" style="text-align: right; height: 30px; line-height: 30px;">
                <a id="btnEp" class="easyui-linkbutton" icon="icon-ok" href="javascript:void(0)" >
                    确定</a> <a id="btnCancel" class="easyui-linkbutton" icon="icon-cancel" href="javascript:void(0)">取消</a>
            </div>
        </div>
    </div>

	<div id="mm" class="easyui-menu" style="width:150px;">
		<div id="mm-tabclose">关闭</div>
		<div id="mm-tabcloseall">全部关闭</div>
		<div id="mm-tabcloseother">除此之外全部关闭</div>
		<div class="menu-sep"></div>
		<div id="mm-tabcloseright">当前页右侧全部关闭</div>
		<div id="mm-tabcloseleft">当前页左侧全部关闭</div>
		<div class="menu-sep"></div>
		<div id="mm-exit">退出</div>
	</div>


</body>
</html>