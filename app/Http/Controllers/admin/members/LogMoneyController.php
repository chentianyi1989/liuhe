<?php

namespace App\Http\Controllers\admin\members;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogMemberMoney;
use App\Models\Member;
class LogMoneyController extends Controller
{
    public function index(Request $request)
    {
        
        return view('admin.members.log_money.index');
    }
    
    public function logMoneyList(Request $request){
        
        $mod = new LogMemberMoney();
        
        if ($request->has('username'))
        {
            $name = $request->get('username');
            $m_list = Member::where('username', 'LIKE', "%$name%")->pluck('id');
            $mod = $mod->whereIn('member_id', $m_list);
        }
        
        if ($request->has('name'))
        {
            $name = $request->get('name');
            $m_list = Member::where('name', 'LIKE', "%$name%")->pluck('id');
            $mod = $mod->whereIn('member_id',$m_list);
        }
        
        $page = $mod->with('member')->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
        return $this->toPage($page);
    }
}
