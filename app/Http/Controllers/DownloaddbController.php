<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloaddbController extends Controller
{
    //
    public function download()
    {
        if (Auth::check()) {
            $result = exec("python D:/LHU/衛保組/system/db.py 2>error.txt");
            if($result == "succes")
                return redirect('punch')->with('success', '已同步連線版資料');
            else
                return redirect('punch')->with('success', '同步失敗');
        }
        else{
            $result = exec("python D:/LHU/衛保組/system/db.py 2>error.txt");
            if($result == "succes")
                return redirect('punch/create')->with('success', '已同步連線版資料');
            else
                return redirect('punch/create')->with('success', '同步失敗');

        }
        
    }
}
