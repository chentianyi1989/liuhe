<?php
namespace App\Http\Controllers\admin\game;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\liuhe\LiuHeService;

class GameInfoController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏结果 start
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
}


































?>