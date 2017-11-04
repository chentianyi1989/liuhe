<?php

namespace App\Http\Controllers\admin\members;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameRecord;
class GameRecordController extends Controller
{
    public function index(Request $request)
    {
        

        return view('admin.members.game_record.index');
    }
    
    public function gameRecordList(Request $request){
        
        $mod = new GameRecord();
        
        $name = $status = $real_name = $register_ip = '';
        if ($request->has('username'))
        {
            $name = $request->get('username');
            $mod = $mod->where('username', 'like', "%$name%");
        }
        
        $page = $mod->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
        return $this->toPage($page);
    }
}
