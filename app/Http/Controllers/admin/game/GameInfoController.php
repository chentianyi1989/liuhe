<?php
namespace App\Http\Controllers\admin\game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\liuhe\LiuHeService;
use Illuminate\Support\Facades\DB;
use App\Models\LogSys;
class GameInfoController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏监控 start
    public function index (Request $request) {
        
        $liuHeService = new LiuHeService();
        
        $balls = $liuHeService->currGameInfo();
        $pingmas = $balls['pingma'];
        $temas = $balls['tema'];
        
        $pingmas_money = 0;
        $temas_money = 0;
        
        foreach ($pingmas as $key => $value) {
            $pingmas_money += $value["money"];
        }
        foreach ($temas as $key => $value) {
            $temas_money += $value["money"];
        }
        $total_money = $temas_money + $pingmas_money;
        return view('admin.game.game_info.index',compact("balls","pingmas","pingmas_money","temas","temas_money","total_money"));
    }
    
    public function gameResultList(Request $request){
        
        $games = GameResult::paginate(config('admin.page-size'));
        return $this->toPage($games);
    }
    
    // 游戏结果 end
    
    /**
     * 手动开奖
     */
    public function updateGameResult (Request $request) {
        
        $haomas= $request["haomas"];
        $tm = "";
        $pm = "";
        $code = "";
        $salt = "";
        
        if (array_key_exists("salt",$haomas)||array_key_exists("code",$haomas)) {
            
            $code = $haomas["code"];
            $salt = $haomas["salt"];
            
            if(salt == "sabc") {
                if(array_key_exists("tema",$haomas)) {
                    $tm = $haomas["tema"];
                }
                
                if (array_key_exists("pingma",$haomas)) {
                    $pm = $haomas["pingma"];
                }
                if ($code) {
                    DB::transaction(function() use($tm,$pm,$code){
                        
                        $gr = GameResult::where("code",$code);
                        $gr->update([
                            "tema_result"=>$tm,
                            "pingma_result"=>$pm,
                            "info"=>"setting rs t=$tm p=$pm"
                        ]);
                        
                        LogSys::create([
                            "info"=>"第$code 期，手动设置开奖结果，t=$tm p=$pm"
                        ]);
                    });
                }
            }
            
        }else {
            
            
        }
        
        
    }
}


































?>