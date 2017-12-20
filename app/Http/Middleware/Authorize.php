<?php

namespace App\Http\Middleware;

use Auth, Route, URL;
use Closure;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
//         echo "guard:$guard";

        $user = auth('user')->user();
        
        if(!$user) {
            if (Auth::guard($guard)->guest()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    //                 echo route("login");
                    return redirect()->guest("login");
                }
            }
        }
        
        
        /* 判断当前用户是否登录或缓存是否过期 */
        
        
        
        
//        $user = Auth::user();
//        if ( ! $user) {
//            return redirect()->to('/auth/logout');
//        }

        /* 判断当前用户是否为超级管理员 */
//         if ($user->is_super_admin) {
//             return $next($request);
//         }

        //获取当前路由
//         $active_router = Route::currentRouteName();
        //获取当前用户所有的权限
//         $own_routers = $user->role->routers()->pluck('router')->toArray();

        //dd($own_routers);exit;

        /* 获取当前 URL 当前的路由、控制器方法和上一页 */
//        $route = Route::current()->getName();
//        $action = Route::current()->getActionName();
//        $previousUrl = URL::previous();

//         if ( ! $request->ajax()) {
//             if ($request->getMethod() == 'GET') {
//                 return $next($request);
//             } else {
//                 if (!in_array($active_router, $own_routers) && !in_array($active_router, ['admin.index']))
//                     return respF('您无权操作，请联系超级管理员');
//             }

//         } else {

//             if (!in_array($active_router, $own_routers) && !in_array($active_router, ['admin.index']))
//                 return responseWrong('您无权操作，请联系超级管理员');
//         }

        return $next($request);
    }
}
