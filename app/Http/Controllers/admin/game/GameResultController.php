<?php
namespace App\Http\Controllers\admin\game;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;

class GameResultController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏结果 start
    public function index (Request $request) {
        
        return view('admin.game.game_result.index');
    }
    
    public function gameResultList(Request $request){
        
        $games = GameResult::paginate(config('admin.page-size'));
        return $this->toPage($games);
    }
    
    // 游戏结果 end
}


































?>