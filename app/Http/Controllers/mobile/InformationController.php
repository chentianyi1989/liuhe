<?php
namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Information;

class InformationController extends Controller
{
    
    public function infos(Request $request){
        
        
        $mod = new Information();
        $dalei = $xiaolei = "";
        if ($request->has('dalei')) {
            $dalei = $request["dalei"];
            $mod = $mod->where('dalei', $dalei);
        }
        if ($request->has('xiaolei')) {
            $xiaolei = $request["xiaolei"];
            $mod = $mod->where('xiaolei', $xiaolei);
        }
        
        $beans = $mod->paginate(config('admin.page-size'));
        return view('mobile.info.infos',compact("beans","dalei","xiaolei"));//,
    }
    
    public function info ($id) {
        
        $bean = Information::findOrFail($id);
        return view('mobile.info.info',compact("bean"));
    }
}