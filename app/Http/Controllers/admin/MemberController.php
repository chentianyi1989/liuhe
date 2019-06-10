<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadService;
use App\Models\Member;
class MemberController extends Controller {
    
    public function index (Request $request) {
        
        $members = Member::paginate(config('admin.page-size'));
        return view('admin.member.index',compact("members"));
    }
    
    public function add (Request $request) {
        return view('admin.member.add');
    }
    
    public function save (Request $request) {
        
        $data = $request->all();
        
//         if(isset($data["tuping"])) {
//             $data["tuping"] = json_encode($data["tuping"]);
//         }
//         $woshi = $data["woshi"];
//         echo "woshi:",$woshi;
        
        if (!empty($data["tuxiang"])) {
            $uploadService = new UploadService();
            $data["tuxiang"] = $uploadService->upload("member",@$data["tuxiang"]);
        }else {
            unset($data["tuxiang"]);
        }
        
        if (!empty($_REQUEST["id"])) {//isset($_REQUEST["id"])
            $id = $_REQUEST["id"];
            $case = Member::findOrFail($id);
            $case->update($data);
        } else {
            $data["password"] = "123456";
            Member::create($data);
        }
        return $this->responseSuccess();
    }
    
    public function edit (Request $request) {
        
        $id = $request["id"];
        $data = $request->all();
        if ($id){
            $bean = Member::findOrFail($id);
        } else {
        }
        return view('admin.member.edit',compact("bean"));
    }
    

    
    public function delete (Request $request) {
        
        @$ids = $request["id"];
        if ($ids){
            Member::destroy($ids);
        } 
        return $this->responseSuccess();
    }
    
}