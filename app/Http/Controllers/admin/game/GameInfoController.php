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
use App\Models\Member;
class GameInfoController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏监控 start
    public function index (Request $request) {
        
        $liuHeService = new LiuHeService();
        
        $currGameResult = GameResult::where("finish","0")->first();
        
        $pingma_result = [];
        if($currGameResult) {
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
        }else {
            echo "当前没有开盘";
        }
        
        
    
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
        
        $_member = new Member();
        
        $username = $request["username"];
        if ($username) {
            $_member = $_member->where("username",$username);
        }
        $name = $request["name"];
        if ($name) {
            $_member = $_member->where("name","like","%$name%");
        }
        
        
        $currGameResult = GameResult::where("finish","0")->first();
        if($currGameResult) {
    //         $gameRecords = GameRecord::where("code","$currGameResult->code")->with('member')->groupBy("member_id")->get([
    //             DB::raw('member_id'),
    //             DB::raw('pingma'),
    //             DB::raw('tema')
                
    //         ]);
    //         foreach ($gameRecords as $key => $value) {
                
    //         }
    //         print_r ($gameRecords);
    //         echo $gameRecords->toJson();
    
            $_members = $_member->with(["gameRecords"=>function($query)use($currGameResult){
                $query->where('code', $currGameResult->code);
            }])->get();
            
            $members = [];
            foreach ($_members as $key =>$value) {
                
                $gameRecord = $value->gameRecords;
                if ($gameRecord && count($gameRecord)>0) {
                    
                    $member = [];
                    $member["id"] = $value->id;
                    $member["name"] = $value->name;
                    $member["money"] = $value->money;
                    $member["username"] = $value->username;
                    $pingma_balls = [];
                    $tema_balls = [];
                    foreach ($gameRecord as $k => $v) {
                        $pingmas = $v->pingma;
                        if ($pingmas) {
                            $pingmas = json_decode($pingmas);
                            foreach($pingmas as $_k => $_v) {
                                $_code = $_v->code;
                                $_ball = [];
                                if(array_key_exists($_code, $pingma_balls)){
                                    $_ball = $pingma_balls[$_code];
                                }else {
                                    $pingma_balls[$_code] = 0;
                                }
                                $pingma_balls[$_code] = $pingma_balls[$_code]+floatval($_v->money);
                            }
                        }
                        $temas = $v->tema;
                        if ($temas) {
                            $temas = json_decode($temas);
                            foreach($temas as $_k => $_v) {
                                $_code = $_v->code;
                                $_ball = [];
                                if(array_key_exists($_code, $tema_balls)){
                                    $_ball = $tema_balls[$_code];
                                }else {
                                    $tema_balls[$_code] = 0;
                                }
                                $tema_balls[$_code] = $tema_balls[$_code]+floatval($_v->money);
                            }
                        }
                    }
                    
                    ksort($pingma_balls);
                    ksort($tema_balls);
                    $member["pingma_balls"] = $pingma_balls;
                    $member["tema_balls"] = $tema_balls;
                    
                    $members[] = $member;
                }
            }
            
    //         print_r($members);
    //         echo $members->toJson();
            
            
    //         $liuService = new LiuHeService();
    //         $balls = $liuService->gameRecordEveryBall($gameRecord);
    
    //         $gameRecord = GameRecord::where("code","$currGameResult->code")->with('member')->groupBy("member_id")->get([
    //             DB::raw('member_id'),
    //             DB::raw('sum(money) as money')
    //         ]);
            
            return view('admin.game.bet_info.index',compact("members","username","name"));
        }else {
            echo "当前没有开盘";
        }
    }
    
    
}


































?>