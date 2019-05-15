<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;
class UploadService
{

    public function upload($dir,UploadedFile $file = null)
    {
        
        
        $info = [];
        try {
            if(empty($file)||$file==""){
                return "";
            }
            
            $fileName = uniqid("file_").".".$file->getClientOriginalExtension();
            $savePath = "/resources/$dir/$fileName";
            if( ! Storage::put($savePath, file_get_contents($file->getRealPath()))){
                return ['message' => '上传文件移动保存失败', 'status' => 0];
            }

            return $savePath;
        }
        catch (\Exception $e) {
            return "";
        }
    }
}