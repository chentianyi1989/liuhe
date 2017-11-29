<?php
namespace App\Http\Controllers\home;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameRecord;
use App\Services\liuhe\LiuHeService;
use App\Models\GameResult;
use App\Models\LogMemberMoney;
class IndexController extends Controller {
    
    //use ValidationTrait;
    
    
    
    public function index(Request $request){
        
        
//         $sysConfig = SysConfig::first();
        return view('home.home');
//         return view('home.index');
    }
    
    public function mb (Request $request) {
        
        return view('home.mabao');
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
                    
                    $flag = false;
                    if(array_key_exists("tema",$haomas)) {
                        $tema_haomas = $haomas["tema"];
                        $gameReord["tema"] = json_encode($tema_haomas,JSON_UNESCAPED_UNICODE);//         $gameReord["tema"] = '[{"moeny":"2","sx":"猴","code":"1"}]';
                        $flag = true;
                    }
                    
                    if (array_key_exists("pingma",$haomas)) {
                        $pingma_haomas = $haomas["pingma"];
                        $gameReord["pingma"] = json_encode($pingma_haomas,JSON_UNESCAPED_UNICODE);
                        $flag = true;
                    }
                    
                    if ($flag == false) {
                        return $this->responseErr("请选择号码！");
                    }
                    $_total = 0;
                    foreach ($tema_haomas as $key => $value){
                        $_total=+$value["money"];
                    }
                    foreach ($pingma_haomas as $key => $value){
                        $_total=+$value["money"];
                    }
                    
                    $gameReord["money"] = $_total;
                    $gameReord["member_id"] = $_user->id;
                    $gameReord["code"] = $code;
                    
                    $member = Member::where("id",$_user->id)->first();
                    if ($member) {
                        DB::transaction(function() use($gameReord,$member){
                            
                            $total_monty = $gameReord["money"];
                            $gr=GameRecord::create($gameReord);
                            $member->update([
                                "money"=>$member->money-$total_monty,
                            ]);
                            LogMemberMoney::create([
                                "money"=>$total_monty,
                                "created_by"=>"$member->username",
                                "info"=>"玩家下注",
                                "type"=>'5',
                                'game_record_id'=>$gr->id,
                                'member_id'=>$gameReord["member_id"]
                            ]);
                        });
                        return $this->responseSuccess("下单成功！单号：$gr->id",route('user.game_record'));
                    }
                }
                return $this->responseErr("下单失败！");
            }else {
                return $this-> responseErr("请先登录！");
            }
            
        }catch (\Exception $e){
//             print_r($e);
            return $this-> responseErr("下单失败！");
        }
    }
    

    
    
    public function index2(Request $request){
        
        
        
        $LiuHeService = new LiuHeService();
        
        $LiuHeService->getResult();
        
//         return view('home.index2');
    }
    
    
    
    
}


































?>