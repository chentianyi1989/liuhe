<?php


namespace App\Services\liuhe;
use App\Models\GameResult;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\LogMemberMoney;
use Illuminate\Support\Facades\DB;
use App\Models\LogSys;
use App\Models\SysConfig;
use Illuminate\Support\Facades\Log;

class LiuHeService{
    
    private $pingma_odds = 6;
    private $tema_odds = 40;
    private $kill = 0.8;
    
    public function __construct() {
        $this->pingma_odds = config('admin.pingma_odds');
        $this->tema_odds = config('admin.tema_odds');
        $this->kill = 1 - config('admin.kill');
        
    }
    
    public function initBall (){
        
        $balls = [];
        for ($x=1; $x<=49; $x++) {
//             $balls[] = ["code"=>$x,"money"=>0];
            $balls[$x] = ["code"=>$x,"money"=>0];
        }
        return $balls;
    }
    
    /**
     * 计算结果
     */
    public function getResult () {
        
        try{
            
            DB::transaction(function() {
                
                $sysConfig = SysConfig::first();
                $currGameResult = GameResult::where("finish","0")->first();
                
                $code = date("mdHi");
                if ($currGameResult) {
                    $updateGameResult = ['finish'=>'1',"lottery_at"=>date('Y-m-d H:i:s'),];
                    $gameRecords = $this->gameRecordByCode($currGameResult->code);
                    if($currGameResult->tema_result && $currGameResult->pingma_result) {
                        $tm = $currGameResult->tema_result;
                        $pm = $currGameResult->pingma_result;
                        
                        $gameResult = ["tema"=>$tm,"pingma"=>explode($pm, ",")];
                        
                    }else if ($currGameResult->tema_result) {
                        
                        $balls = $this->gameRecordEveryBall($gameRecords);
                        $gameResult = $this->calculationResult($balls,$updateGameResult->tema_result);
                        $pm = implode(',',$gameResult['pingma']);
                        $updateGameResult['pingma_result'] = $pm;
                        
                    }else {
                        
                        $balls = $this->gameRecordEveryBall($gameRecords);
                        $gameResult = $this->calculationResult($balls);
                        $pm = implode(',',$gameResult['pingma']);
                        $tm = $gameResult['tema'];
                        
                        $updateGameResult['pingma_result'] = $pm;
                        $updateGameResult['tema_result'] = $tm;
                    }
                    
                    Log::info("gameResult:",$gameResult);
                    $this->payout($gameResult,$gameRecords);
                    
                    $currGameResult->update($updateGameResult);
                }
                
                $currTime = date("H:i:s");
                echo "currTime:$currTime";
                if((strtotime($currTime)-strtotime($sysConfig->start_at))>=0
                    &&(strtotime($currTime)-strtotime($sysConfig->end_at))<0){
                        
                    GameResult::create([
                        'finish'=>'0',
                        'code'=>$code
                    ]);
                            
                        
                }else if ((strtotime($currTime)-strtotime($sysConfig->start_at)<0)) {
                    
                    
                }else if ((strtotime($currTime)-strtotime($sysConfig->end_at)>=0)) {
                    
                }
                
            });
        }catch (\Exception $e){
            LogSys::create([
                'info'=>"开盘错误：$e",
                'created_by'=>"sys"
            ]);
        }
    }
    
    /**
     * 获取第code期的游戏记录
     * @param unknown $code
     * @return unknown
     */
    public function gameRecordByCode($code){
        return GameRecord::where("code","$code")->get();
    }
    
    /**
     * 统计每个号码买了多少钱
     * @param unknown $code
     * @return number[]|number[][][]
     */
    public function gameRecordEveryBall ($gameRecords) {
        
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
            
            // 累计特码下注额
            is_array($tms)?null:$tms = array();
            foreach ($tms as $k => $v) {
                $ball_tema = $balls_tema[$v->code];
                $money = $ball_tema["money"] + $v->money;
                $balls_tema[$v->code]["money"] = $money;
                $tema_money += $v->money;
            }
        }
        
        $_pingmas = [];
        foreach ($balls_pingma as $k =>$v){
            $_pingmas[] = $v;
        }
        
        return ['pingma'=>$_pingmas,'tema'=>$balls_tema];
    }
    
    /**
     * 计算开奖结果
     * @param unknown $balls = {pingma:[{},{}],tema:[{},{}]}
     * @return unknown
     */
    public function calculationResult ($balls,$tema="") {
        
        $balls_pingma = $balls['pingma'];
        $balls_tema = $balls['tema'];
        
//         echo "平码：<br/>";
//         print_r($balls_pingma);
//         echo "<br/>";
//         echo "特码：<br/>";
//         print_r($balls_tema);
//         echo "<br/>";
        
        if (!$tema) {
            $tema_result =  $this->calculationTeMaResult($balls_tema);
        }else {
            $tema_result = $tema;
        }
        
        
       
        
        $pingma_result =  $this->calculationPingMaResult($balls_pingma,$tema_result);
        echo "特码结果：$tema_result <br/>";
        echo "平码结果：<br/>";
        print_r($pingma_result);
        echo "<br/>";
        
        return ["tema"=>$tema_result,"pingma"=>$pingma_result];
        
        
//         $rs = $this->mergeResult($tema_result,$pingma_result);
//         echo "开奖结果：<br/>";
//         print_r($rs);
//         return $rs;
        //         return ["code"=>$code,"result"=>$rs];
    }
    
    /**
     * 计算特码结果
     * 赔率40
     * kill 0.005 * 40 = 0.2
     * @param unknown $balls
     * @return unknown
     */
    public function calculationTeMaResult ($balls) {
        
        $result = [];
        $total_money = 0;
        foreach ($balls as $key => $value) {
            $total_money+=$value["money"];
        }
        if ($total_money>0) {
            foreach ($balls as $key => $value) {
                $rate = ($value["money"] * $this->tema_odds)/$total_money;
                if ($rate < $this->kill) { 
                    $result[]=$value["code"];
                }
            }
            if (count($result)<1) {
                $ball = $this->ballSort($balls)[0];
                $result[]=$ball["code"];
            }
        }else {
            foreach ($balls as $key => $value) {
                $result[]=$value["code"];
            }
        }
        $t_i = mt_rand(0,count($result)-1);
        $tm = $result[$t_i];
        return $tm;
    }
    
    /**
     * 计算平码结果 
     * $balls = [{code:1,money:5},{},{}]
     * 6个号，赔率6
     * @param unknown $balls
     * kill 0.005 * 6 = 0.03 每个号杀数
     *      0.03 * 6 = 0.18 总杀数
     */
    public function calculationPingMaResult ($balls,$tema) {
        
        $total_money = 0;   //总金额
        foreach ($balls as $key => $value) {
            $total_money+=$value["money"];
        }
        if ($total_money>0) {
            
            //先排序
            $balls = $this->ballSort($balls,SORT_DESC);
            $_balls = $balls;
            
            while (5<count($_balls)) {
//                 echo "<br/>".count($_balls)."<br/>";
                $ball_tmp = $_balls;
                $rs = [];
                for ($i=0;$i<6;) {
                    $p_i = mt_rand(0,count($ball_tmp)-1);
                    $pm = $ball_tmp[$p_i];
//                     print_r($pm);
//                     echo "<br/>pingma 下标 ：$p_i, code：".$pm["code"]."<br/>";
                    if ($pm["code"] != $tema) {
                        $rs[] = $pm;
                        $i++;
                    }
                    
                    array_splice($ball_tmp, $p_i, 1);
//                     Log::info("平码删除后$p_i ：",$ball_tmp);
//                     echo "<br/>删除后：<br/>";
//                     print_r($ball_tmp);
//                     echo "<br/>";
                }
//                 echo  "<br/>".count($rs)."<br/>";
//                 print_r($rs);
//                 echo  "<br/>";
                if (6 == count($rs)) {
                    
                    $sumMoney = 0;
                    foreach ($rs as $k => $v) {
                        $sumMoney+=$v["money"];
                    }
                    $rate = $sumMoney * $this->pingma_odds / $total_money ;
//                     echo "<br/>rate:$rate,$this->kill,".($rate<$this->kill)."<br/>";
                    if ($rate < $this->kill) {
                        //return $rs;
//                         echo "ok";
                        break;
                    }else {
//                         echo "no";
//                         print_r($_balls);
//                         echo "<br/>";
                        array_splice($_balls, 0, 1);    //删除最大的金额
//                         print_r($_balls);
//                         echo "<br/>";
                    }
                } else {
                    
                    // 出现错误，停止操作
                }
            }
        } else {
            $rs = [];
            for ($i=0;$i<6;) {
                $p_i = mt_rand(0,count($balls)-1);
                $pm = $balls[$p_i];
                if ($pm["code"] != $tema) {
                    $rs[] = $pm;
                    $i++;
                }
                
//                 echo "<br/>平码删除前i:$i,index: $p_i ：".json_encode($balls)."<br/>";
                array_splice($balls, $p_i, 1);
//                 Log::info("平码删除后,$p_i ：",$balls);
//                 echo "<br/>平码删除后i:$i,index: $p_i ：".json_encode($balls)."<br/>";
            }
        }
//         echo "<br/>rs:";
//         print_r($rs);
        $r = [];
        foreach ($rs as $k => $v) {
            $r[] = $v["code"];
        }
//         echo "<br/>asd";
//         print_r($r);
        return $r;        
        
        //////////////////////////////////////////////////////////////////////////////////////////////////
        
//         $result = [];
//         $kill = 0.005;
//         if ($total_money>0) {
//             foreach ($balls as $key => $value) {
//                 $rate = $value["money"]/$total_money;
//                 if ($rate < $kill) {
//                     $result[$value["code"]]=$value["code"];
//                 }
//             }
//             if (count($result)<6) {
//                 $ball = $this->ballSort($balls);
//                 $result = [];
//                 $result[$ball[0]["code"]] = $ball[0]["code"];
//                 $result[$ball[1]["code"]] = $ball[1]["code"];
//                 $result[$ball[2]["code"]] = $ball[2]["code"];
//                 $result[$ball[3]["code"]] = $ball[3]["code"];
//                 $result[$ball[4]["code"]] = $ball[4]["code"];
//                 $result[$ball[5]["code"]] = $ball[5]["code"];
//             }
//         }else {
//             foreach ($balls as $key => $value) {
//                 $result[$value["code"]]=$value["code"];
//             }
//         }
//         return $result;
    }
    
    
    
    
    
//     public function currGameInfo () {
//         $currGameResult = GameResult::where("finish","0")->first();
//         return $this->gameInfo($currGameResult->code);
//     }
    
    public function gameInfo ($code) {
        $gameRecords = $this->gameRecordByCode($code);
        $balls = $this->gameRecordEveryBall($gameRecords);
        return $balls;
    }
    
    
    public function payout ($gameResult,$gameRecords) {
        
        $pingma_balls = $gameResult["pingma"];
        $tema_ball = $gameResult["tema"];
        
        foreach ($gameRecords as $key => $value) {
            
            $tema_money = 0;
            $pingma_money = 0;
            
            $pingma = $value->pingma;
            $tema = $value->tema;
            $member_id = $value->member_id;
            
            
            echo "游戏记录id：$value->id<br/>";
            
            if ($tema!=null&&$tema!='') {
                $tms = json_decode($tema);
                is_array($tms)?null:$tms = array();
                foreach ($tms as $k => $v) {
                    if($v->code == $tema_ball) {
                        $p_m = $v->money * $this->tema_odds;
                        echo "特码派彩：$v->code,"."money:$v->money ,payout:$p_m" ;
                        $tema_money += $p_m;
                    }
                }
            }
            echo "<br/>";
            if ($pingma!=null&&$pingma!='') {
                $pms = json_decode($pingma);
                is_array($pms)?null:$pms = array();
                foreach ($pms as $k => $v) {
                    foreach ($pingma_balls as $pm => $_v){
                        if($v->code == $pm) {
                            $p_m = $v->money * $this->pingma_odds;
                            echo "平码派彩：$v->code,"."money:$v->money ,payout:$p_m";
                            $pingma_money += $v->money * $this->pingma_odds;
                        }
                    }
                }
            }
            $total_monty = $tema_money+$pingma_money;
            if ($total_monty>0) {
                // 发放中奖金额给用户
                $member = Member::findOrFail($member_id);
                $member->update([
                    "money"=>$member->money+$total_monty,
                ]);
                LogMemberMoney::create([
                    "money"=>$total_monty,
                    "created_by"=>'sys',
                    "info"=>"派彩",
                    "type"=>'3',
                    'game_record_id'=>$value->id,
                    'member_id'=>$value->member_id
                ]);
                $value->update([
                    'money'=>$total_monty
                ]);
                    
            }
        }
    }
    
   
    
    
    /**
     * [$x=>["code"=>$x,"money"=>0]]
     * $x为号码
     * @param unknown $ball
     */
    private function ballSort ($balls,$sort=SORT_ASC) {
        
        foreach ($balls as $key => $value) {
//             $k[$key] = $value["code"];
            $m[$key] = $value["money"];
        }
        array_multisort($m,$sort,$balls);
        return $balls;
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
        for ($i=0;$i<6;) {
            $p_i = mt_rand(0,count($pms)-1);
            echo "<br/>pingma 下标 ：$p_i<br/>";
            print_r($pms);
            echo "<br/>";
            $pm = $_pingmas[$pms[$p_i]];
            if ($pm != $tm) {
                $rs[] = $pm;
                $i++;
            } 
            array_splice($pms, $p_i, 1);
            echo "<br/>删除后：<br/>";
            print_r($pms);
            echo "<br/>";
        }
        $result["tema"] = $tm;
        $result["pingma"] = $rs;
        return $result;
    }
}



