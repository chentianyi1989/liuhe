<?php
namespace App\Http\Controllers\admin;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller {
    
    //use ValidationTrait;
    
    public function index (Request $request) {
        return view('admin.index');
    }
    
}


































?>