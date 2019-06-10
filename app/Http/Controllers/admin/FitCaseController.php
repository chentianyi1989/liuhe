<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FitCase;
use App\Services\UploadService;
class FitCaseController extends Controller {
    
    
    public function add (Request $request) {
        return view('admin.case.add');
    }
    
    public function save (Request $request) {
        
        
        $data = $request->all();
        
//         if(isset($data["tuping"])) {
//             $data["tuping"] = json_encode($data["tuping"]);
//         }
//         $woshi = $data["woshi"];
//         echo "woshi:",$woshi;
        
        $uploadService = new UploadService();
        
        $result = [
//             "id"=>$data["id"],
            "fengge"=>$data["fengge"],
            "leixing"=>$data["leixing"],
            "mianji"=>$data["mianji"],
            "title"=>$data["title"],
            "shejilinian"=>$data["shejilinian"],
        ];
        
        if (!empty($data["huxingtu"])) {
            $result[] = json_encode([
                "name"=>"".$data["huxingtu_name"],
                "url"=>$uploadService->upload("case",@$data["huxingtu"])]);
        }else {
            unset($data["huxingtu"]);
        }
        
        if (!empty($data["keting"])) {
            $result[] = json_encode([
                "name"=>"".$data["keting_name"],
                "url"=>$uploadService->upload("case",@$data["keting"])]);
        }else {
            unset($data["keting"]);
        }
        
        if (!empty($data["woshi"])) {
            $result[] = json_encode([
                "name"=>"".$data["woshi_name"],
                "url"=>$uploadService->upload("case",@$data["woshi"])]);
        }else {
            unset($data["woshi"]);
        }
        
        if (!empty($data["shufang"])) {
            $result[] = json_encode([
                "name"=>"".$data["shufang_name"],
                "url"=>$uploadService->upload("case",@$data["shufang"])]);
        }else {
            unset($data["shufang"]);
        }
        
        if (!empty($data["canting"])) {
            $result[] = json_encode([
                "name"=>"".$data["canting_name"],
                "url"=>$uploadService->upload("case",@$data["canting"])]);
        }else {
            unset($data["canting"]);
        }
        
        if (!empty($data["xunguan"])) {
            $result[] = json_encode([
                "name"=>"".$data["xunguan_name"],
                "url"=>$uploadService->upload("case",@$data["xunguan"])]);
        }else {
            unset($data["xunguan"]);
        }
        
        if (!empty($data["weishengjian"])) {
            $result[] = json_encode([
                "name"=>"".$data["weishengjian_name"],
                "url"=>$uploadService->upload("case",@$data["weishengjian"])]);
        }else {
            unset($data["weishengjian"]);
        }
        
        if (!empty($data["qita"])) {
            $result[] = json_encode([
                "name"=>"".$data["qita_name"],
                "url"=>$uploadService->upload("case",@$data["qita"])]);
        }else {
            unset($data["qita"]);
        }
        
        if (!empty($_REQUEST["id"])) {//isset($_REQUEST["id"])
            $id = $_REQUEST["id"];
            $case = FitCase::findOrFail($id);
            $case->update($result);
        } else {
            FitCase::create($result);
        }
    }
    
    public function edit (Request $request) {
        
        $id = $request["id"];
        $data = $request->all();
        $case = [];
        if ($id){
            $case = FitCase::findOrFail($id);
            $case->update($data);
        } else {
            
        }
        return view('admin.case.edit',compact("case"));
    }
    
    public function index (Request $request) {
        
        
        $cases = FitCase::paginate(config('admin.page-size'));
//         return $this->toPage($games);
        
        return view('admin.case.index',compact("cases"));
    }
    
    public function delete (Request $request) {
        
        @$ids = $request["id"];
        if ($ids){
            FitCase::destroy($ids);
        } 
        return $this->responseSuccess();
    }
    
}