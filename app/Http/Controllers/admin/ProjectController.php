<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BaoJia;

class ProjectController extends Controller
{

    public function create(Request $request){
        
        
        return view('admin.project.create',compact("baoJias"));
    }
}