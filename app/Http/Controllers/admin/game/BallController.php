<?php
namespace App\Http\Controllers\admin\game;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ball;

class BallController extends Controller {
    
    //use ValidationTrait;
    
    
    public function index(Request $request){
        
        return view('admin.game.ball.index');
    }
    
    
    public function ballList(Request $request){
        
        
        $balls = Ball::where('year', "2017")->paginate(config('admin.page-size'));
        
        return $this->toPage($balls);
    }
    
    
}


































?>