<?php
namespace App\Http\Controllers\admin\game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\liuhe\LiuHeService;
use Illuminate\Support\Facades\DB;
use App\Models\LogSys;
use App\Models\GameRecord;
class GameInfoController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏监控 start
    public function index (Request $request) {
        
        $liuHeService = new LiuHeService();
        
        $currGameResult = GameResult::where("finish","0")->first();
        
        $pingma_result = explode(',',$currGameResult->pingma_result);
        
        
        $balls = $liuHeService->gameInfo($currGameResult->code);
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
        return view('admin.game.game_info.index',compact("currGameResult","pingma_result","balls","pingmas","pingmas_money","temas","temas_money","total_money"));
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
        
        
        $tema = $request['tema'];
        $pingma = $request['pingma'];
        $code = $request["code"];
        $salt = $request["salt"];
        if ($pingma) {
            $pingma = implode(",",$pingma);
        }
//         if(salt == "sabc") {
            
            if ($code) {
                DB::transaction(function() use($tema,$pingma,$code){
                    
                    $gr = GameResult::where("code",$code)->first();
                    $gr->update([
                        "tema_result"=>$tema,
                        "pingma_result"=>$pingma,
                        "info"=>"setting rs t=$tema p=$pingma"
                    ]);
                    
                    LogSys::create([
                        "info"=>"第$code 期，手动设置开奖结果，t=$tema p=$pingma"
                    ]);
                });
            }
//         }
        return $this->responseSuccess();
    }
    
    public function betInfo (Request $request) {
        
        $currGameResult = GameResult::where("finish","0")->first();
        $gameRecord = GameRecord::where("code","$currGameResult->code")->with('member')->groupBy("member_id")->get([
            DB::raw('member_id'),
            DB::raw('sum(money) as money')
        ]);
        
        $a = $gameRecord->toJson();
        return view('admin.game.bet_info.index',compact("gameRecord","a"));
    }
}


































?>