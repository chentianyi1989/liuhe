<?php
namespace App\Http\Controllers\mobile\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BaoJia;

class BaoJiaController extends Controller
{

    public function save(Request $request){
        
        
        $data = $request->all();
     
        BaoJia::create($data);
        
        return $this->responseSuccess($data);
    }
}