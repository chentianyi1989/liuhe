<?php
namespace App\Http\Controllers\home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameResult;
use App\Models\GameRecord;

class RecordController extends Controller {
    
    
    public function delGameRecord (Request $request) {
        if ($request->has("id")){
            $id = $request->get("id");
            $_user = auth('member')->user();
            if ($_user){
                $gameRecord = GameRecord::where("member_id","$_user->id")->where("id","$id")->delete();
                return redirect()->action('home\RecordController@gameRecord');
            }else {
                return $this-> responseErr("请先登录！");
            }
        }
    }
    
    public function gameRecord (Request $request) {
        
        $_user = auth('member')->user();
        if ($_user){
            
            $gameResult = GameResult::where("finish","0")->first();
            $gameRecord = GameRecord::where("member_id","$_user->id")->where("code","$gameResult->code")->orderBy('created_at', 'desc')->paginate(9999);
            return view('home.user.game_record',compact("gameRecord"));
        }else {
            return $this-> responseErr("请先登录！");
        }
    }
    
    public function gameRecordHistory (Request $request) {
        
        $_user = auth('member')->user();
        if ($_user){
            $gameResult = GameResult::where("finish","0")->first();
            $gameRecord = GameRecord::where("member_id","$_user->id")->where("code","!=","6")->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
            return view('home.user.game_record_history',compact("gameRecord"));
        }else {
            return $this-> responseErr("请先登录！");
        }
    }
    
    public function gameResultRecord (Request $request) {
        $_user = auth('member')->user();
        if ($_user){
            $gameResult = GameResult::where("finish","1")->orderBy('lottery_at', 'desc')->paginate(config('admin.page-size'));
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

