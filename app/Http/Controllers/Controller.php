<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
        
    public function toPage($page){
        return ["total"=>$page->total(),"rows"=>$page->items()];
    }
    
    public function responseSuccess ($datas=null,$msg="成功",$url="",$code="1"){
        
        return ["msg"=>$msg,"code"=>$code,"url"=>$url,"datas"=>$datas];
    }
    
    public function responseErr ($msg="",$code="99") {
        return ["msg"=>$msg,"code"=>$code];
    }
    
}


