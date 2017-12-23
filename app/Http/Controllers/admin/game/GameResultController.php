<?php
namespace App\Http\Controllers\admin\game;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\LogMemberMoney;
use App\Models\Member;

class GameResultController extends Controller {
    
    //use ValidationTrait;

    
    
    // 游戏结果 start
    public function index (Request $request) {
        
        return view('admin.game.game_result.index');
    }
    
    public function gameResultList(Request $request){
        
        $games = GameResult::orderBy('id', 'desc')->paginate(config('admin.page-size'));
        return $this->toPage($games);
    }
    
    // 游戏结果 end
    
    
    public function recharge (Request $request) {
        
        $mod=$mod1=$mod2 = new LogMemberMoney();
        $username = $name = $start_at= $end_at = "";
        if ($request->has('username'))
        {
            $username = $request->get('username');
            $m_list = Member::where('username', 'LIKE', "%$username%")->pluck('id');
            $mod = $mod->whereIn('member_id', $m_list);
            $mod1 = $mod1->whereIn('member_id', $m_list);
            $mod2 = $mod2->whereIn('member_id', $m_list);
        }
        
        if ($request->has('name'))
        {
            $name = $request->get('name');
            $m_list = Member::where('name', 'LIKE', "%$name%")->pluck('id');
            $mod = $mod->whereIn('member_id',$m_list);
            $mod1 = $mod1->whereIn('member_id',$m_list);
            $mod2 = $mod2->whereIn('member_id',$m_list);
        }
        
        if ($request->has('start_at')){
            $start_at = $request->get('start_at');
            $mod = $mod->where('created_at',">=",$start_at);
            $mod1 = $mod1->where('created_at',">=",$start_at);
            $mod2 = $mod2->where('created_at',">=",$start_at);
        }
        if ($request->has('end_at')){
            $end_at = $request->get('end_at');
            $mod = $mod->where('created_at',"<=",$end_at);
            $mod1 = $mod1->where('created_at',"<=",$end_at);
            $mod2 = $mod2->where('created_at',"<=",$end_at);
        }
        
        $total_recharge = $mod1->where("type","1")->sum("money");
        $total_withdrawal = $mod2->where("type","2")->sum("money");
        
        $logMemberMoney = $mod->with('member')->where(function($query){
            $query->orWhere("type","1")->orWhere("type","2");
        })->orderBy('created_at', 'desc')->paginate(12);
        
        return view('admin.game.game_result.recharge',compact("logMemberMoney","total_recharge","total_withdrawal","username","name","start_at","end_at"));
    }
    
    public function outcome (Request $request) {
//         DB::listen(function($sql) {
//             dump($sql);
//             echo "$sql->sql<br/>";
            // dump($sql->bindings);
//         });
        
        $mod4 = $mod3 = $mod2 = $mod = new LogMemberMoney();
        $username = $name = $start_at= $end_at = "";
        if ($request->has('username'))
        {
            $username = $request->get('username');
            $m_list = Member::where('username', 'LIKE', "%$username%")->pluck('id');
            
            $mod = $mod->whereIn('member_id', $m_list);
            $mod2 = $mod2->whereIn('member_id', $m_list);
            $mod3 = $mod3->whereIn('member_id', $m_list);
            $mod4 = $mod4->whereIn('member_id', $m_list);
        }
        
        if ($request->has('name'))
        {
            $name = $request->get('name');
            $m_list = Member::where('name', 'LIKE', "%$name%")->pluck('id');
            $mod = $mod->whereIn('member_id', $m_list);
            $mod2 = $mod2->whereIn('member_id', $m_list);
            $mod3 = $mod3->whereIn('member_id', $m_list);
            $mod4 = $mod4->whereIn('member_id', $m_list);
        }
        
        if ($request->has('start_at')){
            $start_at = $request->get('start_at');
            $mod = $mod->where('created_at',">=",$start_at);
            $mod2 = $mod2->where('created_at',">=",$start_at);
            $mod3 = $mod3->where('created_at',">=",$start_at);
            $mod4 = $mod4->where('created_at',">=",$start_at);
        }
        if ($request->has('end_at')){
            $end_at = $request->get('end_at');
            $mod = $mod->where('created_at',"<=",$end_at);
            $mod2 = $mod2->where('created_at',"<=",$end_at);
            $mod3 = $mod3->where('created_at',"<=",$end_at);
            $mod4 = $mod4->where('created_at',"<=",$end_at);
        }
        
        
        $logMemberMoney = $mod->where(function($query){
            $query->orWhere("type","3")->orWhere("type","5")->orWhere("type","6");  
        })->orderBy('created_at', 'desc')->with('member')->paginate(12);
        
        $total_payout = $mod2->where("type","3")->sum("money");
        $total_bet = $mod3->where("type","5")->sum("money");
        $total_cancelBet = $mod4->where("type","6")->sum("money");
        
        return view('admin.game.game_result.outcome',compact("logMemberMoney","total_payout","total_bet","total_cancelBet","username","name","start_at","end_at"));
    }
    
    
    
}


































?>