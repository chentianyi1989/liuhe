<?php
namespace App\Http\Controllers\admin;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\LogMemberLogin;
use Hash;
use App\Models\GameRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller {
    
    //use ValidationTrait;
    
    protected $redirectTo = '/';
    
    public function index(Request $request){
        
        return view('admin.login');
    }
    
    public function login(Request $request){
        
        $username = $request->get('username');
        $password = $request->get('password');
        
        $url = $request->get('url');
        
        $member = Member::where("username",$username)->find(1) ;
        
        if ($member->password==$password) {
            Auth::guard('member')->login($member);
            return redirect()->intended('/');
        }
        
        return responseWrong('用户名或密码错误');
    }
    
    public function logout(Request $request) {
        auth('user')->logout();
        return redirect()->intended('/');
    }
    
    public function ajaxLogin (Request $request){
        $member = Member::where('username', $request->get('username'))->first();
        if (!$member){
            $result["code"] = 99;
            $result["msg"] = '用户名或密码错误';
            return $result;
        }else{
            if (!hash::check($request->get('password'), $member->password)){
                $result["code"] = 99;
                $result["msg"] = '用户名或密码错误';
                return $result;
            }else {
                $request->session()->put('daili_login_info', $member);
                
                $log["member_id"] = $member->id;
                $log["username"] = $member->username;
                $log["ip"] = $request->getClientIp();
                LogMemberLogin::create($log);
                
                $result["code"] = 0;
                $result["msg"] = '登陆成功';
                return $result;
            }
        }
    }
    
}


?>