<?php

namespace App\Http\Controllers\admin\members;
use App\Models\LogMemberMoney;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        

        return view('admin.members.member.index');
    }
    
    public function memberList(Request $request){
        
        $mod = new Member();
        
        $name = $status = $real_name = $register_ip = '';
        if ($request->has('username'))
        {
            $name = $request->get('username');
            $mod = $mod->where('username', 'like', "%$name%");
        }
        if ($request->has('name'))
        {
            $real_name = $request->get('name');
            $mod = $mod->where('name', 'like', "%$real_name%");
        }
        
        $page = $mod->orderBy('created_at', 'desc')->paginate(config('admin.page-size'));
        return $this->toPage($page);
    }

    public function add (Request $request){
        
        $username = $request->get('username');
        $name = $request->get('name');
        
        try{
            
            $member = Member::where("username",$username)->get();
            if (!$member) {
                $data = $request->all();
                $data["money"] = 0;
                $data["password"] = "123456";
                Member::create($data);
                return $this->responseSuccess("添加用户$username 成功！");
            }
            return $this-> responseErr("用户名：$username 已经存在！");
        }catch (\Exception $e){
            return $this-> responseErr("添加用户$username 失败！");
        }
    }
    
    public function updateUser (Request $request){
        
        try{
            $username = $request->get('username');
            $phone = $request->get('phone');
            $name = $request->get('name');
            $id = $request->get("id");
            $member = Member::findOrFail($id);
            
            $data["name"] = $name;
            $data["phone"] = $phone;
            $member->update($data);
            $result["code"] = "0";
        }catch (\Exception $e){
            return $this-> responseErr("修改用户$username 失败！");
        }
        
        return $this->responseSuccess("修改用户$username 成功！");
    }
    public function recharge (Request $request) {
        $id = $request->get("id");
        $money = $request->get('money');
//         echo is_numeric($money)."  $money    $id";
        
        if(is_numeric($money)&&$money>=0&&$id) {
            DB::transaction(function() use($id,$money){
                $member = Member::findOrFail($id);
                $member->update([
                    'money'=>$member->money+$money
                ]);
                
                LogMemberMoney::create([
                    "money"=>$money,
                    "created_by"=>'',
                    "info"=>"充值",
                    "type"=>config('log_member_moneny.type.recharge'),
                    'member_id'=>$member->id
                ]);
            });
            return $this->responseSuccess('充值成功');
        }else{
            return $this-> responseErr("充值失败！");
        }
        
    }
    public function withdrawal (Request $request) {
        
        $id = $request->get("id");
        $money = $request->get('money');
        if(is_numeric($money)&&$money>=0&&$id) {
            
            DB::transaction(function()use($id,$money) {
                $member = Member::findOrFail($id);
                $member->update([
                    'money'=>$member->money-$money
                ]);
                
                LogMemberMoney::create([
                    "money"=>$money,
                    "created_by"=>'',
                    "info"=>"提现",
                    "type"=>config('log_member_moneny.type.withdrawal'),
                    'member_id'=>$member->id
                ]);
            });
            return $this->responseSuccess('取现成功');
        }else{
            return $this-> responseErr("取现失败！");
        }
    }
    

    public function export(Request $request)
    {
        $map = [];
        if ($request->has('name'))
        {
            $name = $request->get('name');
            $map['name'] = ['name', 'like', "%$name%"];
        }

        if ($request->has('realname'))
        {
            $realname = $request->get('realname');
            $map['realname'] = ['realname', 'like', "%$realname%"];
        }

        //默认不显示超级管理员
        $map['is_super_admin'] = 0;
        $data = MemberRepository::getByWhere($map)->toArray();

        Excel::create('测试', function ($excel) use ($data) {
            $excel->sheet('Sheetname', function ($sheet) use ($data) {
                $sheet->rows(
                    $data
                );
            });
        })->download('xls');
    }

}
