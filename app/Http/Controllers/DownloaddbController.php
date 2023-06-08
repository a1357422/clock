<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloaddbController extends Controller
{
    //
    public function download()
    {
        $result = exec("python D:/至昊/system/db.py");
        if($result == "已執行.ps1檔案。"){
            return redirect('punch/create')->with('success', '已同步連線版資料');
        }
        
    }
}
