<?php


namespace App\Services\liuhe;
use App\Models\GameResult;
use App\Models\GameRecord;
use App\Models\Member;
use App\Models\LogMemberMoney;
use Illuminate\Support\Facades\DB;

class LiuHeService{
    
    private $pingma_odds = 6;
    private $tema_odds = 40;
    
    public function __construct() {
        $pingma_odds = config('admin.pingma_odds');
        $tema_odds = config('admin.tema_odds');
    }
    
    public function initBall (){
        
        $balls = [];
        for ($x=1; $x<=49; $x++) {
            $balls[$x] = ["code"=>$x,"money"=>0];
        }
        return $balls;
    }
    
    public function currGameInfo () {
        $currGameResult = GameResult::where("finish","0")->first();
        return $this->gameInfo($currGameResult->code);
    }
    
    public function gameInfo ($code) {
        $gameRecords = $this->gameRecordByCode($code);
        $balls = $this->gameRecordEveryBall($gameRecords);
        return $balls;
    }
    
    public function getResult () {
        DB::transaction(function() {
            $gr = $this->startNext ();
            $code = $gr->code;
            $gameRecords = $this->gameRecordByCode($code);
            $balls = $this->gameRecordEveryBall($gameRecords);
            $gameResult = $this->calculationResult($balls);
            $this->payout($gameResult,$gameRecords);
            
            
            $pm = implode(',',$gameResult['pingma']);
            $tm = $gameResult['tema'];
            $gr->update([
                'pingma_result'=>$pm,
                'tema_result'=>$tm
            ]);
        });
    }
    
    /**
     * 关闭当前盘，开下一个盘
     */
    public function startNext () {
        $currGameResult = GameResult::where("finish","0")->first();
        $code = date("Ymd").$currGameResult->id;
        $currGameResult->update([
            'finish'=>'1'
        ]);
        
        GameResult::create([
            'finish'=>'0',
            'code'=>$code
        ]);
        return $currGameResult;
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
                    foreach ($pingma_balls as $pm){
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
//                 DB::transaction(function() use($member,$money,$value){
                $member->update([
                    "money"=>$member->money+$total_monty,
                ]);
                LogMemberMoney::create([
                    "money"=>$total_monty,
                    "created_by"=>'sys',
                    "info"=>"派彩中奖的游戏记录",
                    "type"=>'3',
                    'game_record_id'=>$value->id,
                    'member_id'=>$value->member_id
                ]);
                $value->update([
                    'money'=>$total_monty
                ]);
                    
//                 });
            }
        }
    }
    
    public function gameRecordByCode($code){
        return GameRecord::where("code","$code")->get();
    }
    
    /**
     * 每个号码买了多少钱
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
            
            //             累计特码下注额
            is_array($tms)?null:$tms = array();
            foreach ($tms as $k => $v) {
                $ball_tema = $balls_tema[$v->code];
                $money = $ball_tema["money"] + $v->money;
                $balls_tema[$v->code]["money"] = $money;
                
                $tema_money += $v->money;
            }
        }
        return ['pingma'=>$balls_pingma,'tema'=>$balls_tema];
    }
    
    /**
     * $balls 每个号码统计的金额
     * @param unknown $balls
     * @return unknown
     */
    public function calculationResult ($balls) {
        
//         $currGameResult = GameResult::where("finish","0")->first();
//         $code = $currGameResult->code;
        
       
//         // 保存游戏记录的总金额
//         $value->update([
//             "tema_money"=>$tema_money,
//             "pingma_money"=>$pingma_money,
//         ]);
        $balls_pingma = $balls['pingma'];
        $balls_tema = $balls['tema'];
        
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
        if ($total_money>0) {
            foreach ($balls as $key => $value) {
                $rate = $value["money"]/$total_money;
                if ($rate < $kill) {
                    $result[$value["code"]]=$value["code"];
                }
            }
            if (count($result)<1) {
                $ball = $this->ballSort($balls)[0];
                $result[$ball["code"]]=$ball["code"];
            }
        }else {
            foreach ($balls as $key => $value) {
                $result[$value["code"]]=$value["code"];
            }
        }
        return $result;
    }
    
    /**
     * [$x=>["code"=>$x,"money"=>0]]
     * $x为号码
     * @param unknown $ball
     */
    private function ballSort ($balls) {
        foreach ($balls as $key => $value) {
//             $k[$key] = $value["code"];
            $m[$key] = $value["money"];
        }
        array_multisort($m,SORT_ASC,$balls);
        return $balls;
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
        
        if ($total_money>0) {
            foreach ($balls as $key => $value) {
                $rate = $value["money"]/$total_money;
                if ($rate < $kill) {
                    $result[$value["code"]]=$value["code"];
                }
            }
            if (count($result)<6) {
                $ball = $this->ballSort($balls);
                $result = [];
                $result[$ball[0]["code"]] = $ball[0]["code"];
                $result[$ball[1]["code"]] = $ball[1]["code"];
                $result[$ball[2]["code"]] = $ball[2]["code"];
                $result[$ball[3]["code"]] = $ball[3]["code"];
                $result[$ball[4]["code"]] = $ball[4]["code"];
                $result[$ball[5]["code"]] = $ball[5]["code"];
            }
        }else {
            foreach ($balls as $key => $value) {
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



