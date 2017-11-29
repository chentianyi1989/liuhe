<?php

namespace App\Providers;

use App\Models\SystemNotice;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Member;
use Session;
use App\Models\SysConfig;
use App\Models\GameResult;
use Illuminate\Support\Facades\Auth;
class ViewServiceProvider extends ServiceProvider
{
    protected $auth_user,$admin_aside,$admin,$auth_member,$web,$web_header,$auth_daili,$daili_aside,$wap,$system_notice;

    public function __construct()
    {
        $this->auth_user = [
            'admin.layouts.header',
            'admin.layouts.aside',
            'admin.user.*',
        ];
        $this->auth_member = [
            'web.*',
            'member.layouts.header',
            'member.*',
        ];

        $this->auth_daili = [
            'daili.*',
        ];

        $this->daili_aside = [
            'daili.layouts.aside',
        ];

        $this->admin_aside = [
            'admin.layouts.aside'
        ];

        $this->admin = [
            'admin.*'
        ];

        $this->web = [
            'web.*',
            'member.*'
        ];

        $this->wap = [
            'wap.*',
        ];

        $this->web_header = [
            'web.*',
            'member.*'
        ];

        $this->system_notice = [
            'web.*',
            'web.layouts.header',
            'wap.index'
        ];
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            $_sysConfig= SysConfig::first();
            //             $_api_list = Api::where('on_line', 0)->orderBy('created_at', 'desc')->pluck('api_name', 'id')->toArray();
            
            $gameResult = GameResult::where("finish","1")->orderBy('code', 'desc')->paginate(5);
            foreach ($gameResult as $key => $val) {
                $result = $val["pingma_result"];
                $result = explode(",",$result);
                foreach ($result as $k => $v) {
                    if (strlen($v)<2) {
                        $v = "0".$v;
                        $result[$k] = $v;
                    }
                }
                $val["pingma_result"] = $result;
                
                if (strlen($val["tema_result"])<2) {
                    $val["tema_result"] = "0".$val["tema_result"];
                }
            }
            
            $currGameResult = GameResult::where("finish","0")->first();
            
            
            $_user = auth('member')->user();
//             echo $_user;
            $view->with(compact('_sysConfig',"gameResult","currGameResult","_user"));
            
        });
        
        
        
        
        
//         view()->composer($this->auth_user, function ($view) {
//             $_user = Auth::user();
//             $view->with(compact(''));
//         });

//         view()->composer($this->system_notice, function ($view) {
//             $_system_notices = SystemNotice::where('on_line', 0)->orderBy('sort', 'asc')->orderBy('created_at', 'desc')->get();
//             $view->with(compact('_system_notices'));
//         });

//         view()->composer($this->auth_daili, function ($view) {
//             $mod = Session::get('daili_login_info');
//             $_daili = $mod ? Member::findOrFail($mod->id):'';
//             $view->with(compact('_daili'));
//         });

//         view()->composer($this->daili_aside,function($view){

//             $active_route = Route::currentRouteName();
//             $view->with(compact('active_route'));
//         });

//         view()->composer($this->admin_aside,function($view){

//             $active_route = Route::currentRouteName();
//             $user = Auth::user();
//             $_user_routers = $user->is_super_admin == 1?[]:Auth::user()->role->routers()->pluck('router')->toArray();
//             $view->with(compact('active_route', '_user_routers'));
//         });

//         view()->composer($this->admin, function ($view) {
//             $_daili_list = Member::where('is_daili', 1)->pluck('name', 'id');
//             $view->with(compact('_daili_list'));
//         });

//         view()->composer($this->web, function ($view) {

//             $web_route = Route::currentRouteName();
//             $_member = auth('member')->user();
//             $view->with(compact('web_route', '_member'));
//         });

//         view()->composer($this->wap, function ($view) {
//             $_member = auth('member')->user();
//             $_wap_router = Route::currentRouteName();
//             $view->with(compact( '_member','_wap_router'));
//         });

//         view()->composer($this->web_header, function ($view) {
//             $member = auth('member')->user();
//             $_not_read_message_num = $member?$member->messages()->where('is_read', 0)->count():0;
//             $view->with(compact('_not_read_message_num'));
//         });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
