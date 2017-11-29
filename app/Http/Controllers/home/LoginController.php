<?php
namespace App\Http\Controllers\home;



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
        
    }
    
    public function login(Request $request){
        
//         echo "login";
        $username = $request->get('username');
        $password = $request->get('password');
        
//         echo "$username,$password";
        $url = $request->get('url');
        
        if (Auth::guard('member')->attempt(['username' => $username,'password'=>$password],true))
        {
            //return respS('登录成功',  route('member.index'));
            $member = auth('member')->user();
//             $member->update([
//                 'is_login' => 1
//             ]);
            LogMemberLogin::create([
                'member_id' => $member->id,
                'ip' => $request->getClientIp(),
                'username' => $member->username,
            ]);
//             var_dump(Session::all());
//             $_user = auth('member')->user();
//             echo "_user:$_user,id:$id";
            
            return redirect()->intended('/');
        }
        return responseWrong('用户名或密码错误');
    }
    
    
    public function logout(Request $request) {
        auth('member')->logout();
//         $request->session()->forget('daili_login_info');
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
    
    
    
    public function bet (Request $request) {
        
        
        
        try{
            $haomas= $request["haomas"];
            $tema_haomas = $haomas["tema"];
            $gameReord = [];
            $gameReord["tema"] = json_encode($tema_haomas,JSON_UNESCAPED_UNICODE);
            //         $gameReord["tema"] = '[{"moeny":"2","sx":"猴","code":"1"}]';
            echo json_encode($gameReord["tema"]);
            $gameReord["member_id"] = 1;
            $gameReord["name"] = "test";
            $gameReord["code"] = "";
            
            GameRecord::create($gameReord);
        }
        catch (\Exception $e){
            $error_code = $e->errorInfo[1];
            return 'houston, we have a duplicate entry problem';
        }
        
        return "code1";
    }
    
    
    
    public function gameRecord (Request $request) {
        
        $gameRecord = GameRecord::orderBy('created_at', 'desc')->paginate(5);
        
        
        return view('home.user.game_record',compact("gameRecord"));
    }
    
    public function index2(Request $request){
        
        return view('home.index2');
    }
}


































?>