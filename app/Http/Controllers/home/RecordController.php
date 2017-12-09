<?php
namespace App\Http\Controllers\home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameResult;
use App\Models\GameRecord;
use Illuminate\Support\Facades\DB;
use App\Models\LogMemberMoney;
class RecordController extends Controller {
    
    
    public function delGameRecord (Request $request) {
        if ($request->has("id")){
            $id = $request->get("id");
            $_user = auth('member')->user();
            if ($_user){
                $gameRecord = GameRecord::where("member_id","$_user->id")->where("id","$id")->first();
                $member = Member::where("id","$_user->id")->first();
                
                try{
                    DB::beginTransaction();
                
                    $member->update([
                        "money"=>$member->money+$gameRecord->money
                    ]);
                    LogMemberMoney::create([
                        "money"=>$gameRecord->money,
                        "created_by"=>"$member->username",
                        "info"=>"下注撤单",
                        "type"=>'6',
                        'game_record_id'=>$gameRecord->id,
                        'member_id'=>$member->id
                    ]);
                    $gameRecord->delete();
                    DB::commit();
                    return redirect()->action('home\RecordController@gameRecord');
                }catch (\Exception $e1) {
                    DB::rollback();
                }
                
                return $this-> responseErr("撤单失败！");
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
            //->where("code","!=","6")
            $gameResult = GameResult::where("finish","0")->first();
            $gameRecord = GameRecord::where("member_id","$_user->id")->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
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

