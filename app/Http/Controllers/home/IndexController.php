<?php
namespace App\Http\Controllers\home;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameRecord;
use App\Services\liuhe\LiuHeService;
class IndexController extends Controller {
    
    //use ValidationTrait;
    
    
    
    public function index(Request $request){
        
        
//         $sysConfig = SysConfig::first();
        
        
        
        return view('home.index');
    }
    
    public function bet (Request $request) {
        
        try{
            
            $_user = auth('member')->user();
            if ($_user){
                $haomas= $request["haomas"];
                $tema_haomas = $haomas["tema"];
                $gameReord = [];
                $gameReord["tema"] = json_encode($tema_haomas,JSON_UNESCAPED_UNICODE);//         $gameReord["tema"] = '[{"moeny":"2","sx":"猴","code":"1"}]';
                $pingma_haomas = $haomas["pingma"];
                $gameReord["pingma"] = json_encode($pingma_haomas,JSON_UNESCAPED_UNICODE);
                $gameReord["member_id"] = $_user->id;
                $gameReord["code"] = $haomas["code"];
                
                $gr=GameRecord::create($gameReord);
                
//                 redirect()->intended(route('user.game_record'));
                return $this->responseSuccess("下单成功！单号：$gr->id",route('user.game_record'));
            }else {
                return $this-> responseErr("请先登录！");
            }
            
        }catch (\Exception $e){
//             $error_code = $e->errorInfo[1];
            return $this-> responseErr("下单失败！");
        }
    }
    

    
    
    public function index2(Request $request){
        
        
        
        $LiuHeService = new LiuHeService();
        
        $LiuHeService->calculationResult();
        
//         return view('home.index2');
    }
    
    
    
    
}


































?>