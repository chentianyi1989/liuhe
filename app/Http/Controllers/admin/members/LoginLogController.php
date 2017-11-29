<?php

namespace App\Http\Controllers\admin\members;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogMemberLogin;
class LogMoneyController extends Controller {
    
    public function index(Request $request){
        
        return view('admin.members.log_money.index');
    }
    
}
