<?php


namespace App\Services\liuhe;
use App\Models\GameResult;
use App\Models\GameRecord;




class LiuHeService{
    
    public function initBall (){
        
        $balls = [];
        for ($x=1; $x<=49; $x++) {
            $balls[$x] = ["code"=>$x,"money"=>0];
        }
        return $balls;
    }
    
    public function payout ($gameResult,$gameRecords) {
        
        $pingma_balls = $gameResult["pingma"];
        $tema_ball = $gameResult["tema"];
        
        $tema_money = 0;
        $pingma_money = 0;
        
        foreach ($gameRecords as $key => $value) {
            
            $pingma = $value->pingma;
            $tema = $value->tema;
            
            $pms = json_decode($pingma);
            $tms = json_decode($tema);
            
            is_array($pms)?null:$pms = array();
            foreach ($tms as $k => $v) {
                if($v->code == $tema_ball) {
                    $pingma_money += $v->money * 6;
                }
            }
            
            is_array($tms)?null:$tms = array();
            foreach ($tms as $k => $v) {
                if($v->code == $tema_ball) {
                    $tema_money += $v->money * 40;
                }
            }
        }
        
        
        
    }
    
    public function calculationResult () {
        
        $currGameResult = GameResult::where("finish","0")->first();
        $code = $currGameResult->code;
        
        $gameRecords = GameRecord::where("code","$code")->get();
        $balls_pingma = $this->initBall ();
        $balls_tema = $this->initBall ();
        
        
        foreach ($gameRecords as $key => $value){
            $pingma = $value->pingma;
            $tema = $value->tema;
            
            $pms = json_decode($pingma);
            $tms = json_decode($tema);
            $tema_money = 0;
            $pingma_money = 0;
            // 累计平码下注额
            is_array($pms)?null:$pms = array();
            foreach ($pms as $k => $v) {
                $ball_pingma = $balls_pingma[$v->code];
                $money = $ball_pingma["money"] + $v->money;
                $balls_pingma[$v->code]["money"] = $money;
                
                $pingma_money += $v->money;
            }
            
//             累计特码下注额
            is_array($tms)?null:$tms = array();
            foreach ($tms as $k => $v) {
                $ball_tema = $balls_tema[$v->code];
                $money = $ball_tema["money"] + $v->money;
                $balls_tema[$v->code]["money"] = $money;
                
                $tema_money += $v->money;
            }
            
            $value->update([
                "tema_money"=>$tema_money,
                "pingma_money"=>$pingma_money,
            ]);
        }
        echo "平码：<br/>";
        print_r($balls_pingma);
        echo "<br/>";
        echo "特码：<br/>";
        print_r($balls_tema);
        echo "<br/>";
        
        $pingma_result =  $this->calculationPingMaResult($balls_pingma);
        echo "平码结果：<br/>";
        print_r($pingma_result);
        echo "<br/>";
        
        $tema_result =  $this->calculationTeMaResult($balls_tema);
        echo "特码结果：<br/>";
        print_r($tema_result);
        
        
        $rs = $this->mergeResult($tema_result,$pingma_result);
        echo "开奖结果：<br/>";
        print_r($rs);
        return $rs;
//         return ["code"=>$code,"result"=>$rs];
    }
    
    
    
    /**
     * 计算特码结果
     * 赔率40
     * kill 0.005 * 40 = 0.2
     */
    public function calculationTeMaResult ($balls) {
        
        $result = [];
        $kill = 0.005;
        $total_money = 0;
        foreach ($balls as $key => $value) {
            $total_money+=$value["money"];
        }
        
        foreach ($balls as $key => $value) {
            $rate = $value["money"]/$total_money;
            if ($rate < $kill) {
                $result[$value["code"]]=$value["code"];
            }
        }
        
        return $result;
    }
    
    /**
     * 计算平码
     * 6个号，赔率6
     * @param unknown $balls
     * kill 0.005 * 6 = 0.03 每个号杀数
     *      0.03 * 6 = 0.18 总杀数
     */
    public function calculationPingMaResult ($balls) {
        
        $result = [];
        $kill = 0.005;
        $total_money = 0;
        foreach ($balls as $key => $value) {
            $total_money+=$value["money"];
        }
        
        foreach ($balls as $key => $value) {
            $rate = $value["money"]/$total_money;
            if ($rate < $kill) {
                $result[$value["code"]]=$value["code"];
            }
        }
        return $result;
        
    }
    
    /**
     * 
     * @param array $tema
     * @param array $pingma
     */
    public function mergeResult ($temas=[],$pingmas=[]) {
        
        
        foreach ($temas as $k => $v){
            $tms[] = $v;
        }
        $t_i = mt_rand(0,count($tms));
        $tm = $temas[$tms[$t_i]];
        echo "<br/>tm:$tm<br/>";
        
        foreach ($pingmas as $k => $v){
            $pms[] = $v;
        }
        $_pingmas = $pingmas;
        
        
        $rs = [];
        echo "pingma 下标 ：";
        for ($i=0;$i<6;) {
            $p_i = mt_rand(0,count($pms));
            echo "$p_i<br/>";
            print_r($pms);
            echo "<br/>";
            $pm = $_pingmas[$pms[$p_i]];
            if ($pm != $tm) {
                array_splice($pms, $p_i, 1);
                $rs[] = $pm;
                $i++;
            } else {
                array_splice($pms, $p_i, 1);
            }
        }
        $result["tema"] = $tm;
        $result["pingma"] = $rs;
        return $result;
    }
}



