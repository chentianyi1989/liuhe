<?php
?>

<div id="header">
    <div class="control n_anniu">
        <div class="buttons">
            <label class="checkdefault">
                <span class="color_lv bold">玩法说明：</span>
            </label>
            <label class="quickAmount"><span class="color_lv bold">每期开奖1个号码，每个号码赔率为40</span>
            </label>
        </div>
        <div class="buttons">
            <label class="checkdefault">
                <span class="color_lv bold">预设金额：</span>
            </label>
            <label class="quickAmount"><span class="color_lv bold">金额</span>
                <input class="quickmoney" maxlength="6" id="tema_input_money"
                	onfocusout="this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$" 
                	onmouseout="this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$" 
                	onkeyup="this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$" 
                	onkeydown="this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$" 
                	onkeypress="if ((event.keyCode<48 || event.keyCode>57)) event.returnValue=false" 
                	onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,'').replace(/^0+/g,''))">
            </label>
        </div>
    </div>
</div>

<table class="table_ball" id="tema_table">
	<thead>
		<tr class="head">
			<th>号码</th>
			<th>生肖</th>
			<th class="ha">金额</th>
			<th>号码</th>
			<th>生肖</th>
			<th class="ha">金额</th>
			<th>号码</th>
			<th>生肖</th>
			<th class="ha">金额</th>
			<th>号码</th>
			<th>生肖</th>
			<th class="ha">金额</th>
			<th>号码</th>
			<th>生肖</th>
			<th class="ha">金额</th>
		</tr>
	</thead>
</table>
<!-- <form method="post" action="{{ route('home.bet') }}" id="form_tema_bet"> -->
<!-- </form> -->
