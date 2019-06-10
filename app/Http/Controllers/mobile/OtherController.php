<?php
namespace App\Http\Controllers\mobile;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameRecord;
use App\Services\liuhe\LiuHeService;
use App\Models\GameResult;
use App\Models\LogMemberMoney;
class OtherController extends Controller {
    
    //use ValidationTrait;
    
    
    public function xianxiamendian (Request $request) {
        return view('mobile.other.xianxiamendian');
    }
    
    public function baojia (Request $request) {
        return view('mobile.other.baojia');
    }
    
    public function yanfang (Request $request) {
        
        return view('mobile.other.yanfang');
    }
    
    public function bet (Request $request) {
        
        try{
            $_user = auth('member')->user();
            if ($_user){
                
                $haomas= $request["haomas"];
                $code = $haomas["code"];
                
                $currGameResult = GameResult::where("finish","0")->where("code","$code")->first();
                if ($currGameResult) {
                    $gameReord = [];
                    $_total = 0;
                    $flag = false;
                    if(array_key_exists("tema",$haomas)) {
                        $tema_haomas = $haomas["tema"];
                        $gameReord["tema"] = json_encode($tema_haomas,JSON_UNESCAPED_UNICODE);//         $gameReord["tema"] = '[{"moeny":"2","sx":"猴","code":"1"}]';
                        foreach ($tema_haomas as $key => $value){
                            $_total+=$value["money"];
                        }
                        $flag = true;
                    }
                    
                    if (array_key_exists("pingma",$haomas)) {
                        $pingma_haomas = $haomas["pingma"];
                        $gameReord["pingma"] = json_encode($pingma_haomas,JSON_UNESCAPED_UNICODE);
                        foreach ($pingma_haomas as $key => $value){
                            $_total+=$value["money"];
                        }
                        $flag = true;
                    }
                    
                    if ($flag == false) {
                        return $this->responseErr("请选择号码！");
                    }
                    if ($_user->money<$_total) {
                        
                        return $this-> responseErr("下单失败，余额不足");
                    }
                    
                    
                    $gameReord["money"] = $_total;
                    $gameReord["member_id"] = $_user->id;
                    $gameReord["code"] = $code;
                    
                    $member = Member::where("id",$_user->id)->first();
                    if ($member) {
                        try{
                            DB::beginTransaction();
                            $total_monty = $gameReord["money"];
                            $gr=GameRecord::create($gameReord);
                            $member->update([
                                "money"=>$member->money-$_total,
                            ]);
                            LogMemberMoney::create([
                                "money"=>$_total,
                                "created_by"=>"$member->username",
                                "info"=>"玩家下注",
                                "type"=>'5',
                                'game_record_id'=>$gr->id,
                                'member_id'=>$gameReord["member_id"]
                            ]);
                            DB::commit();
                            return $this->responseSuccess("下单成功！单号：$gr->id",route('user.game_record'));
                        }catch (\Exception $e1) {
                            DB::rollback();
                        }
                    }
                }
                return $this->responseErr("下单失败！");
            }else {
                return $this-> responseErr("请先登录！");
            }
            
        }catch (\Exception $e){
//             print_r($e);
            return $this-> responseErr("下单失败$e ！");
        }
    }
    
    public function rechargeRecord (Request $request) {
        
        $_user = auth('member')->user();
        if ($_user){
            $logMemberMoney = LogMemberMoney::orWhere("type","1")->orWhere("type","2")->paginate(20);
            return view('home.user.recharge',compact("logMemberMoney"));
        }else{
            return $this-> responseErr("请先登录！");
        }
    }
    
    
    public function index2(Request $request){
        
        
        
        $LiuHeService = new LiuHeService();
        
        $LiuHeService->getResult();
        
//         return view('home.index2');
    }
    
    
    
    
}


































?>