<?php
namespace App\Http\Controllers\mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FitCase;

class FitCaseController extends Controller
{

    public function index(Request $request){
        
        $cases = FitCase::paginate(config('admin.page-size'));
        foreach ($cases as $case) {
            @$case->fengge_name = config("sys.fengge")[$case->fengge];
            @$case->leixing_name = config("sys.leixing")[$case->leixing];
        }
        return view('mobile.case.index',compact("cases"));
    }
    
    public function caseOne(Request $request,$id){
        
        $case = FitCase::findOrFail($id);
        @$case->fengge_name = config("sys.fengge")[$case->fengge];
        @$case->leixing_name = config("sys.leixing")[$case->leixing];
        return view('mobile.case.case',compact("case"));
    }
    
    
}