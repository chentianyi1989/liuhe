<?php
namespace App\Http\Controllers\home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameResult;
use App\Models\GameRecord;

class RecordController extends Controller {
    
    
    public function gameRecord (Request $request) {
        
        $_user = auth('member')->user();
        if ($_user){
            $gameRecord = GameRecord::where("member_id","$_user->id")->orderBy('created_at', 'desc')->paginate(2);
            return view('home.user.game_record',compact("gameRecord"));
        }else {
            return $this-> responseErr("请先登录！");
        }
    }
    
    public function gameResultRecord (Request $request) {
        $_user = auth('member')->user();
        if ($_user){
            $gameResult = GameResult::where("finish","1")->orderBy('lottery_at', 'desc')->paginate(5);
            foreach ($gameResult as $key => $val) {
                $result = $val["pingma_result"];
                $result = explode(",",$result);
                foreach ($result as $k => $v) {
                    if (strlen($v)<2) {
                        $v = "0".$v;
                        $result[$k] = $v;
                    }
                }
                $val["pingma_result"] = $result;
                
                if (strlen($val["tema_result"])<2) {
                    $val["tema_result"] = "0".$val["tema_result"];
                }
            }
            return view('home.user.game_result',compact("gameResult"));
        }else {
            return $this-> responseErr("请先登录！");
        }
        
    }
    
    public function rechargeRecord (Request $request) {
        
    }
    
    public function withdrawalRecord (Request $request) {
        
    }
}














?>

