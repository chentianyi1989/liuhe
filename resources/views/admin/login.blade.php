<?php
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>登录</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
	<form action="{{route('login.login')}}" method="post">
    	用户名：<input name="username"><br/>
    	密码：<input name="password">
    	<input type="submit" value="登录"/>
	</form>

</body>


</html>