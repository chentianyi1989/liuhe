<?php
namespace App\Http\Controllers\admin\index;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller {
    
    //use ValidationTrait;
    
    
    
    public function index(Request $request){
        
        return view('admin.layouts.index');
    }
    
}


































?>