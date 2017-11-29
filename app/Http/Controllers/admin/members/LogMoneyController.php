<?php

namespace App\Http\Controllers\admin\members;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogMemberMoney;
class LoginLogController extends Controller
{
    public function index(Request $request)
    {
        

        return view('admin.members.log_money.index');
    }
    
    public function logMoneyList(Request $request){
        
        $mod = new LogMemberMoney();
        
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
