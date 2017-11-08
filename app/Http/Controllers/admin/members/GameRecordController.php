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
        //
        $page = $mod->with('member')->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
        
//         print_r($page->tojson());
        
//         foreach ($page as $item =>$v) {
//             echo $v->member->username;
//         }
        
//         print_r($page->tojson());
//         return json_encode($page);
//         return $page;
//         $page->items()
        return $this->toPage($page);
    }
}
