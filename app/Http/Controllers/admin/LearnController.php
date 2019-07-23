<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadService;
use App\Models\Learn;
class LearnController extends Controller {
    
    public function index (Request $request) {
        
        $beans = Learn::paginate(config('admin.page-size'));
        return view('admin.learn.index',compact("beans"));
    }
    
    public function lists () {
        $beans = Learn::paginate(config('admin.page-size'));
        return view('admin.learn.lists',compact("beans"));
    }
    
    public function add (Request $request) {
        return view('admin.member.add');
    }
    
    public function save (Request $request) {
        
        $data = $request->all();
        
        if (!empty($data["url"])) {
            $uploadService = new UploadService();
            $data["url"] = $uploadService->upload("learn",@$data["url"]);
        }else {
            unset($data["url"]);
        }
        
        if (!empty($_REQUEST["id"])) {//isset($_REQUEST["id"])
            $id = $_REQUEST["id"];
            $case = Learn::findOrFail($id);
            $case->update($data);
        } else {
            Learn::create($data);
        }
        return $this->responseSuccess();
    }
    
    public function edit (Request $request) {
        
        $id = $request["id"];
        $data = $request->all();
        $bean = [];
        if ($id){
            $bean = learn::findOrFail($id);
        } else {
        }
        return view('admin.learn.edit',compact("bean"));
    }
    
    public function delete (Request $request) {
        
        @$ids = $request["id"];
        if ($ids){
            Learn::destroy($ids);
        } 
        return $this->responseSuccess();
    }
    
}