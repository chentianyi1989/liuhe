<div class="box2 bg-white mt10">
    <div class="form-common-title">
        <div class="title">我家装修需要多少钱？</div>
    </div>
    <div class="form-common-body">
        <form id="price" method="post" action="{{route('mobile.api.baojia.save')}}">
            <input type="hidden"  name="source" value="H5平台分站首页免费获取家装报价">
            <div class="form-input">
                <input class="text-sub bg-form" type="text" name="mianji"  placeholder="您的房屋面积" validate="required|number" autocomplete="off">
            </div>
            <div class="form-input">
                <input class="text-sub bg-form" type="text" name="phone" placeholder="您的手机号码" validate="required|phone" autocomplete="off" maxlength="11">
            </div>
            <input type="submit" class="button button-primary full-w" value="立即获取" >
        </form>

        <div class="tel sub">
            <p>您的信息将被严格保密！稍后会有专业人员致电为您服务</p>
        </div>
    </div>
    <script type="text/javascript">
//     	function baojia() {
//     		$("#price").baojia();
//     	}
        $(function () {
        	$("#price").ajaxForm(function (resp) {
        		alert("报价成功");
        	});
        })
    </script>
</div>


@section('mate.js')

@endsection