<?php



$rs = [
    "dama"=>[],
    "xiaoma"=>[],
    "danma"=>[],
    "xiaodan"=>[],
    "dadan"=>[],
    "shuangma"=>[],
    "xiaoshuang"=>[],
    "dashuang"=>[],
    "hedan"=>[],
    "heshuang"=>[],
    "heda"=>[],
    "hexiao"=>[],
    
    "tou0"=>[],
    "tou1"=>[],
    "tou2"=>[],
    "tou3"=>[],
    "tou4"=>[],
    "wei0"=>[],
    "wei1"=>[],
    "wei2"=>[],
    "wei3"=>[],
    "wei4"=>[],
    "wei5"=>[],
    "wei6"=>[],
    "wei7"=>[],
    "wei8"=>[],
    "wei9"=>[],
    
    "shengxiao_shu"=>[],
    "shengxiao_niu"=>[],
    "shengxiao_hu"=>[],
    "shengxiao_tu"=>[],
    "shengxiao_long"=>[],
    "shengxiao_she"=>[],
    "shengxiao_ma"=>[],
    "shengxiao_yang"=>[],
    "shengxiao_hou"=>[],
    "shengxiao_ji"=>[],
    "shengxiao_gou"=>[],
    "shengxiao_zhu"=>[],
    
    "red"=>[],
    "red_dan"=>[],
    "red_shuang"=>[],
    "red_da"=>[],
    "red_xiao"=>[],
    
    "blue"=>[],
    "blue_dan"=>[],
    "blue_shuang"=>[],
    "blue_da"=>[],
    "blue_xiao"=>[],
    
    "green"=>[],
    "green_dan"=>[],
    "green_shuang"=>[],
    "green_da"=>[],
    "green_xiao"=>[]
];


for ($i=1;$i<=49;$i++) {
    
    if($i>=25) {
        $rs["dama"][] = $i;
        if ($i%2==1) {
            $rs["dadan"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["dashuang"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }else {
        $rs["xiaoma"][] = $i;
        if ($i%2==1) {
            $rs["xiaodan"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["xiaoshuang"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }
    
    $gewei = $i%10;
    $shiwei = intval($i/10);
    $heshu =  $gewei + $shiwei;
    if ($heshu>=7) {
        $rs["heda"][] = $i;
    }else {
        $rs["hexiao"][] = $i;
    }
    if ($heshu%2==1) {
        $rs["hedan"][] = $i;
    }else {
        $rs["heshuang"][] = $i;
    }
    
    if($shiwei == 0) {
        $rs["tou0"][] = $i;
    }else if ($shiwei == 1) {
        $rs["tou1"][] = $i;
    }else if ($shiwei == 2) {
        $rs["tou2"][] = $i;
    }else if ($shiwei == 3) {
        $rs["tou3"][] = $i;
    }else if ($shiwei == 4) {
        $rs["tou4"][] = $i;
    }
    
    if($gewei == 0) {
        $rs["wei0"][] = $i;
    }else if($gewei == 1) {
        $rs["wei1"][] = $i;
    }else if($gewei == 2) {
        $rs["wei2"][] = $i;
    }else if($gewei == 3) {
        $rs["wei3"][] = $i;
    }else if($gewei == 4) {
        $rs["wei4"][] = $i;
    }else if($gewei == 5) {
        $rs["wei5"][] = $i;
    }else if($gewei == 6) {
        $rs["wei6"][] = $i;
    }else if($gewei == 7) {
        $rs["wei7"][] = $i;
    }else if($gewei == 8) {
        $rs["wei8"][] = $i;
    }else if($gewei == 9) {
        $rs["wei9"][] = $i;
    }
    
    $sx=$i%12;
    if($sx == 1) {
        $rs["shengxiao_hou"][] = $i;
    }else if ($sx == 2){
        $rs["shengxiao_ji"][] = $i;
    }else if ($sx == 3){
        $rs["shengxiao_gou"][] = $i;
    }else if ($sx == 4){
        $rs["shengxiao_zhu"][] = $i;
    }else if ($sx == 5){
        $rs["shengxiao_shu"][] = $i;
    }else if ($sx == 6){
        $rs["shengxiao_niu"][] = $i;
    }else if ($sx == 7){
        $rs["shengxiao_hu"][] = $i;
    }else if ($sx == 8){
        $rs["shengxiao_tu"][] = $i;
    }else if ($sx == 9){
        $rs["shengxiao_long"][] = $i;
    }else if ($sx == 10){
        $rs["shengxiao_she"][] = $i;
    }else if ($sx == 11){
        $rs["shengxiao_ma"][] = $i;
    }else if ($sx == 0){
        $rs["shengxiao_yang"][] = $i;
    }
}


for ($i=1;$i<=49;$i++) {
    
    if($i>=25) {
        $rs["dama"][] = $i;
        if ($i%2==1) {
            $rs["danma_da"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["shuangma_da"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }else {
        $rs["xiaoma"][] = $i;
        if ($i%2==1) {
            $rs["danma_xiao"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["shuangma_xiao"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }
    
    $gewei = $i%10;
    $shiwei = intval($i/10);
    $heshu =  $gewei + $shiwei;
    if ($heshu>=7) {
        $rs["heda"][] = $i;
    }else {
        $rs["hexiao"][] = $i;
    }
    if ($heshu%2==1) {
        $rs["hedan"][] = $i;
    }else {
        $rs["heshuang"][] = $i;
    }
    
    if($shiwei == 0) {
        $rs["tou0"][] = $i;
    }else if ($shiwei == 1) {
        $rs["tou1"][] = $i;
    }else if ($shiwei == 2) {
        $rs["tou2"][] = $i;
    }else if ($shiwei == 3) {
        $rs["tou3"][] = $i;
    }else if ($shiwei == 4) {
        $rs["tou4"][] = $i;
    }
    
    if($gewei == 0) {
        $rs["wei0"][] = $i;
    }else if($gewei == 1) {
        $rs["wei1"][] = $i;
    }else if($gewei == 2) {
        $rs["wei2"][] = $i;
    }else if($gewei == 3) {
        $rs["wei3"][] = $i;
    }else if($gewei == 4) {
        $rs["wei4"][] = $i;
    }else if($gewei == 5) {
        $rs["wei5"][] = $i;
    }else if($gewei == 6) {
        $rs["wei6"][] = $i;
    }else if($gewei == 7) {
        $rs["wei7"][] = $i;
    }else if($gewei == 8) {
        $rs["wei8"][] = $i;
    }else if($gewei == 9) {
        $rs["wei9"][] = $i;
    }
}

// print_r($rs);
// foreach ($rs as $key => $value) {
//     echo "\"$key\":[";
//     foreach ($value as $v){
//         echo $v.",";
//     }
//     echo "]\n";
// }
    


?>

<script type="text/javascript">
<!--
<?php echo "var kuaujie = ".json_encode($rs).";"; ?>
//-->

$(function () {


	$("#quick_sec_table td").click(function(i){

		var button = $(this);
		var key=button.attr("data");
		var clazz = "sple-"+key+"-select";
		
		button.toggleClass('active');
// 		alert(key);
// 		  alert(val+"->"+"->"+1);

		var haomas = kuaujie[key];
// 		var l = "";
// 		for (var i in haomas) {
// 			l+=haomas[i]+","
// 		}
// 		alert(l);
		
// 	alert($("#pingma_table td").length);

		var money = $("#tema_input_money").val();
		
		$("#tema_table td").each(function (){
			var _name = $(this).attr("name")
			var _clazz = $(this).attr("class")
			for (var i in haomas) {
				var label_name = "tema_label_td"+haomas[i];
				var val_name = "tema_val_td"+haomas[i];
				if (val_name==_name||label_name==_name) {

					if (val_name==_name&&button.hasClass('active')) {
						$(this).find("input").val(money);
					}else {
						$(this).find("input").val("");
					}
					
					if (button.hasClass('active')) {
						$(this).addClass(clazz);
					}else {
						$(this).removeClass(clazz);
					}
					
					break;
				}

				
			}
		});
	});

	
});


</script>
        <table id="quick_sec_table" class="">
            <thead>
                <tr>
                    <th colspan="3" class="table_side">特码快捷投注</th>
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
                    <td data="col-red-" class="red">红</td>
                    <td data="col-blue-" class="blue">蓝</td>
                    <td data="col-green-" class="green">绿</td>
                </tr>
                <tr>
                    <td data="col-red-dan" class="red">红单</td>
                    <td data="col-blue-dan" class="blue">蓝单</td>
                    <td data="col-green-dan" class="green">绿单</td>
                </tr>
                <tr>
                    <td data="col-red-shuang" class="red">红双</td>
                    <td data="col-blue-shuang" class="blue">蓝双</td>
                    <td data="col-green-shuang" class="green">绿双</td>
                </tr>
                <tr>
                    <td data="col-red-da" class="red">红大</td>
                    <td data="col-blue-da" class="blue">蓝大</td>
                    <td data="col-green-da" class="green">绿大</td>
                </tr>
                <tr>
                    <td data="col-red-xiao" class="red">红小</td>
                    <td data="col-blue-xiao" class="blue">蓝小</td>
                    <td data="col-green-xiao" class="green">绿小</td>
                </tr>
                <tr>
                    <td data="sple-all">全选</td>
                    <td colspan="2" data="sple-clear">取消</td>
                </tr>
            </tbody>
        </table>