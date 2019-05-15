<?php
namespace App\Http\Controllers\mobile\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FitCase;

class FitCaseController extends Controller
{

    public function index(Request $request){
        
        
        $cases = FitCase::paginate(config('admin.page-size'));
        
     
        foreach ($cases as $case) {
            $fengge = $case->fengge;
            $leixing = $case->leixing;
            @$case->fengge_name = config("sys.fengge")[$fengge];
            @$case->leixing_name = config("sys.leixing")[$leixing];
            
        }
        return $this->responseSuccess($cases);
    }
}