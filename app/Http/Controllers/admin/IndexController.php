<?php
namespace App\Http\Controllers\admin;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\GameRecord;
use App\Services\liuhe\LiuHeService;
use App\Models\GameResult;
use App\Models\LogMemberMoney;
class IndexController extends Controller {
    
    //use ValidationTrait;
    
    public function index (Request $request) {
        return view('admin.index');
    }
    
}


































?>