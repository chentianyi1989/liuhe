<?php

namespace App\Http\Controllers\admin\members;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogMemberLogin;
class LoginLogController extends Controller
{
    public function index(Request $request)
    {
        

        return view('admin.members.loginlog.index');
    }
    
    public function loginLogList(Request $request){
        
        $mod = new LogMemberLogin();
        
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
