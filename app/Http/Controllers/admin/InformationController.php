<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Services\UploadService;
class InformationController extends Controller
{
    
    public function index(Request $request){
        
        $beans = Information::paginate(config('admin.page-size'));
        return view('admin.information.index',compact("beans"));//,
    }
    
    public function edit (Request $request) {
        
        $id = $request["id"];
        $data = $request->all();
        $bean = [];
        if ($id){
            $bean = Information::findOrFail($id);
            $bean->update($data);
        } else {
            
        }
        return view('admin.information.edit',compact("bean"));
    }
    
    public function save (Request $request) {
        
        $data = $request->all();
        
        
        
        if (!empty($data["tuxiang"])) {
            $uploadService = new UploadService();
            $data["tuxiang"] = $uploadService->upload("information",@$data["tuxiang"]);
        }else {
            unset($data["tuxiang"]);
        }
        
        if (!empty($_REQUEST["id"])) {//isset($_REQUEST["id"])
            $id = $_REQUEST["id"];
            $case = Information::findOrFail($id);
            $case->update($data);
        } else {
            Information::create($data);
        }
        return $this->responseSuccess();
    
    }
}