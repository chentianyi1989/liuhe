
<script type="text/javascript">

$(function () {

	
	$("#quick_sec_table_pingma td").click(function(i){

		var button = $(this);
		var key=button.attr("data");

		if("sple-clear"==key) {
			$("#quick_sec_table_pingma td").each(function () {
				if($(this).hasClass('active')){
					$(this).toggleClass('active');
				}
			});
			clearPingMa ();
			return ;
		}
		
		var clazz = "sple-select";
		
		button.toggleClass('active');
	
		var haomas = [];
		$("#quick_sec_table_pingma td").each(function () {
			if($(this).hasClass('active')){
				var _key = $(this).attr("data");
				haomas = $.unique(haomas.concat(kuaujie[_key]));
			}
		});
		var money = $("#pingma_input_money").val();
		clearPingMa ();
		$("#pingma_table td").each(function (){
			var _name = $(this).attr("name");
			var _clazz = $(this).attr("class");
			for (var i in haomas) {
				var label_name = "pingma_label_td"+haomas[i];
				var val_name = "pingma_val_td"+haomas[i];
				if (val_name==_name||label_name==_name) {

					$(this).find("input").val(money);
					$(this).addClass(clazz);
					break;
				}
			}
		});
	});
});
function clearPingMa () {

	$("#pingma_table td").each(function (){
		$(this).find("input").val("");
		$(this).removeClass("sple-select");
	});
}

</script>
        <table id="quick_sec_table_pingma" class="quick_sec_table">
            <thead>
                <tr>
                    <th colspan="3" class="table_side">平码快捷投注</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data="danma">单码</td>
                    <td data="xiaodan">小单</td>
                    <td data="hedan">合单</td>
                </tr>
                <tr>
                    <td data="shuangma">双码</td>
                    <td data="xiaoshuang">小双</td>
                    <td data="heshuang">合双</td>
                </tr>
                <tr>
                    <td data="dama">大码</td>
                    <td data="dadan">大单</td>
                    <td data="heda">合大</td>
                </tr>
                <tr>
                    <td data="xiaoma">小码</td>
                    <td data="dashuang">大双</td>
                    <td data="hexiao">合小</td>
                </tr>
                <tr>
                    <td data="tou0">0头</td>
                    <td data="wei0">0尾</td>
                    <td data="wei5">5尾</td>
                </tr>
                <tr>
                    <td data="tou1">1头</td>
                    <td data="wei1">1尾</td>
                    <td data="wei6">6尾</td>
                </tr>
                <tr>
                    <td data="tou2">2头</td>
                    <td data="wei2">2尾</td>
                    <td data="wei7">7尾</td>
                </tr>
                <tr>
                    <td data="tou3">3头</td>
                    <td data="wei3">3尾</td>
                    <td data="wei8">8尾</td>
                </tr>
                <tr>
                    <td data="tou4">4头</td>
                    <td data="wei4">4尾</td>
                    <td data="wei9">9尾</td>
                </tr>
                <tr>
                    <td data="shengxiao_shu">鼠</td>
                    <td data="shengxiao_long">龙</td>
                    <td data="shengxiao_hou">猴</td>
                </tr>
                <tr>
                    <td data="shengxiao_niu">牛</td>
                    <td data="shengxiao_she">蛇</td>
                    <td data="shengxiao_ji">鸡</td>
                </tr>
                <tr>
                    <td data="shengxiao_hu">虎</td>
                    <td data="shengxiao_ma">马</td>
                    <td data="shengxiao_gou">狗</td>
                </tr>
                <tr>
                    <td data="shengxiao_tu">兔</td>
                    <td data="shengxiao_yang">羊</td>
                    <td data="shengxiao_zhu">猪</td>
                </tr>
                <tr>
                    <td data="red" class="red">红</td>
                    <td data="blue" class="blue">蓝</td>
                    <td data="green" class="green">绿</td>
                </tr>
                <tr>
                    <td data="red_dan" class="red">红单</td>
                    <td data="blue_dan" class="blue">蓝单</td>
                    <td data="green_dan" class="green">绿单</td>
                </tr>
                <tr>
                    <td data="red_shuang" class="red">红双</td>
                    <td data="blue_shuang" class="blue">蓝双</td>
                    <td data="green_shuang" class="green">绿双</td>
                </tr>
                <tr>
                    <td data="red_da" class="red">红大</td>
                    <td data="blue_da" class="blue">蓝大</td>
                    <td data="green_da" class="green">绿大</td>
                </tr>
                <tr>
                    <td data="red_xiao" class="red">红小</td>
                    <td data="blue_xiao" class="blue">蓝小</td>
                    <td data="green_xiao" class="green">绿小</td>
                </tr>
                <tr>
<!--                     <td data="sple-all">全选</td> -->
                    <td colspan="3" data="sple-clear">取消</td>
                </tr>
            </tbody>
        </table>