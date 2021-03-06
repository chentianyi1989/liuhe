<?php
namespace App\Http\Controllers\admin\game;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameRecord;
use App\Models\SysConfig;

class GameController extends Controller {
    
    
    
    public function index(Request $request){
        
        return view('admin.game.game.index');
    }
    
    public function gameList(Request $request){
        
        
        $gameRecord = GameRecord::paginate(config('admin.page-size'));
        
        return $this->toPage($gameRecord);
    }
    
    /**
     * 系统设置
     */
    public function sysConfig (Request $request) {
        
        $sys_config = SysConfig::first();
        
        return view('admin.game.sys_config.index',compact("sys_config"));
    }
    
    public function sysConfigUpdate (Request $request) {
        
        $sys["title"] = $request["title"];
        $sys["note"] = $request["note"];
        $sys["state"] = $request["state"];
        $sys["start_at"] = $request["start_at"];
        $sys["end_at"] = $request["end_at"];
        $sys["step"] = $request["step"];
        
        $sys_config = SysConfig::first();
        $sys_config->update($sys);
        return $this->responseSuccess("修改成功！");
    }
}


































?>