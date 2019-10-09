<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BaoJia;

class BaoJiaController extends Controller
{

    public function index(Request $request){
        
        
        
        $baoJias = BaoJia::paginate(9999);//config('admin.page-size')
        //         return $this->toPage($games);
        return view('admin.baoJia.index',compact("baoJias"));
    }
}