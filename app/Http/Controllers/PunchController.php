<?php

namespace App\Http\Controllers;

use App\Models\Basesalary;
use App\Models\Punch;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PunchController extends Controller
{
    //
    public function index(){
        if (Auth::check()){
            $date = strval(date('n')-1);
        }
        else{
            $date = strval(date('n'));
        }
        $users = User::Where('name','<>',"管理員")->orderBy('id','asc')->get();
        $basesalary = Basesalary::first();
        $basesalary = $basesalary->basesalary;
        $tags = [];
        $totalmoneys = [];
        $hourtags = [];
        $total = 0;
        foreach($users as $user){
            $hours = [];
            $minutes = [];
            $totalhours = 0;
            $totalminute = 0;
            $notes = [];
            $punches = Punch::Punch($date)->Where('nameid',$user->id)->get();
            foreach($punches as $punch){
                if ($punch->note != null){
                    array_push($notes,$punch->note);
                }
                array_push($hours,substr($punch->time,0,1));
                array_push($minutes,mb_substr($punch->time,2,2));
            }
            foreach($minutes as $minute){
                $totalminute += intval($minute);
            }
            foreach($hours as $hour){
                $totalhours += intval($hour);
            }
            if($totalminute >= 60){
                $count = floor($totalminute/60);
                $totalminute = $totalminute%=60;
                $totalhours += $count;
            }
            if($user->role == 1){
                $totalhours += floor($totalminute/60)+3;
                $note_tag = "";
                $count = 0;
                $notes = array_unique($notes);
                foreach ($notes as $note){
                    $note_tag = $note_tag . $note;
                    if (count($notes) == 1){
                        $note_tag = $note_tag;
                        break;
                    }
                    if ($count == count($notes)-1){
                        break;
                    }
                    else{
                        if ($count == count($notes)){
                            $note_tag = $note_tag;
                            break;
                        }
                        else{
                            $note_tag = $note_tag . "+";
                            $count += 1;
                        }
                    }
                }
                if($totalminute >= 50 && $totalminute <= 59){
                    $totalminute = 0;
                    $totalhours += 1;
                }
                if($totalminute >= 1 && $totalminute <= 10)
                    $totalminute = 0;
                if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分".'(含社長三小時)'; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分"."(含社長三小時+$note_tag)"; 
                }
                $money = $totalhours*$basesalary;
            }
            else{
                $totalhours += floor($totalminute/60);
                $note_tag = "含";
                $count = 0;
                $notes = array_unique($notes);
                foreach ($notes as $note){
                    $note_tag = $note_tag . $note;
                    if (count($notes) == 1){
                        $note_tag = $note_tag;
                        break;
                    }
                    if ($count == count($notes)-1){
                        break;
                    }
                    else{
                        if ($count == count($notes)){
                            $note_tag = $note_tag;
                            break;
                        }
                        else{
                            $note_tag = $note_tag . "+";
                            $count += 1;
                        }
                    }
                }
                if($totalminute >= 50 && $totalminute <= 59){
                    $totalminute = 0;
                    $totalhours += 1;
                }
                if($totalminute >= 1 && $totalminute <= 10)
                    $totalminute = 0;
                if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分"; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分" ."($note_tag)"; 
                } 
                $money = $totalhours*$basesalary;
            }
            $tags["$user->id"] = $text;
            $totalmoneys["$user->id"] = $money;
            $hourtags["$user->id"] = $totalhours;
        }
        foreach($totalmoneys as $totalmoney){
            $total += $totalmoney;
        }
        return view('punch.index',['basesalary'=>$basesalary,'users'=>$users,'date'=>$date,'tags'=>$tags,'totalmoneys'=>$totalmoneys,'hourtags'=>$hourtags,'total'=>$total]);
    }

    public function record(Request $request){
        $date = $request->input('month');
        $users = User::Where('name','<>',"管理員")->orderBy('id','asc')->get();
        $basesalary = Basesalary::first();
        $basesalary = $basesalary->basesalary;
        $tags = [];
        $totalmoneys = [];
        $hourtags = [];
        $total = 0;
        foreach($users as $user){
            $hours = [];
            $minutes = [];
            $totalhours = 0;
            $totalminute = 0;
            $notes = [];
            $punches = Punch::Punch($date)->Where('nameid',$user->id)->get();
            foreach($punches as $punch){
                if ($punch->note != null){
                    array_push($notes,$punch->note);
                }
                array_push($hours,substr($punch->time,0,1));
                array_push($minutes,mb_substr($punch->time,2,2));
            }
            foreach($minutes as $minute){
                $totalminute += intval($minute);
            }
            foreach($hours as $hour){
                $totalhours += intval($hour);
            }
            if($totalminute >= 60){
                $count = floor($totalminute/60);
                $totalminute = $totalminute%=60;
                $totalhours += $count;
            }
            if($user->role == 1){
                $totalhours += floor($totalminute/60)+3;
                $note_tag = "";
                $count = 0;
                $notes = array_unique($notes);
                foreach ($notes as $note){
                    $note_tag = $note_tag . $note;
                    if (count($notes) == 1){
                        $note_tag = $note_tag;
                        break;
                    }
                    if ($count == count($notes)-1){
                        break;
                    }
                    else{
                        if ($count == count($notes)){
                            $note_tag = $note_tag;
                            break;
                        }
                        else{
                            $note_tag = $note_tag . "+";
                            $count += 1;
                        }
                    }
                }
                if($totalminute >= 50 && $totalminute <= 59){
                    $totalminute = 0;
                    $totalhours += 1;
                }
                if($totalminute >= 1 && $totalminute <= 10)
                    $totalminute = 0;
                if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分".'(含社長三小時)'; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分"."(含社長三小時+$note_tag)"; 
                }
                $money = $totalhours*$basesalary;
            }
            else{
                $totalhours += floor($totalminute/60);
                $note_tag = "含";
                $count = 0;
                $notes = array_unique($notes);
                foreach ($notes as $note){
                    $note_tag = $note_tag . $note;
                    if (count($notes) == 1){
                        $note_tag = $note_tag;
                        break;
                    }
                    if ($count == count($notes)-1){
                        break;
                    }
                    else{
                        if ($count == count($notes)){
                            $note_tag = $note_tag;
                            break;
                        }
                        else{
                            $note_tag = $note_tag . "+";
                            $count += 1;
                        }
                    }
                }
                if($totalminute >= 50 && $totalminute <= 59){
                    $totalminute = 0;
                    $totalhours += 1;
                }
                if($totalminute >= 1 && $totalminute <= 10)
                    $totalminute = 0;
                if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分"; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分" ."($note_tag)"; 
                } 
                $money = $totalhours*$basesalary;
            }
            $tags["$user->id"] = $text;
            $totalmoneys["$user->id"] = $money;
            $hourtags["$user->id"] = $totalhours;
        }
        foreach($totalmoneys as $totalmoney){
            $total += $totalmoney;
        }
        return view('punch.index',['basesalary'=>$basesalary,'users'=>$users,'date'=>$date,'tags'=>$tags,'totalmoneys'=>$totalmoneys,'hourtags'=>$hourtags,'total'=>$total]);
    }
    
    public function show($id){
        $date = strval(date('n'));
        $punches = Punch::Where('year',date('Y'))->Where('nameid',$id)->where('date','like',"$date%")->latest()->get();
        $user = User::Where('id',$id)->first();
        $basesalary = Basesalary::first();
        $basesalary = $basesalary->basesalary;
        $hours = [];
        $minutes = [];
        $totalhours = 0;
        $totalminute = 0;
        $totalmoneys = [];
        $hourtags = [];
        $notes = [];
        foreach($punches as $punch){
            if ($punch->note != null){
                array_push($notes,$punch->note);
            }
            array_push($hours,substr($punch->time,0,1));
            array_push($minutes,mb_substr($punch->time,2,2));
        }
        foreach($minutes as $minute){
            $totalminute += intval($minute);
        }
        foreach($hours as $hour){
            $totalhours += intval($hour);
        }
        if($totalminute >= 60){
            $count = floor($totalminute/60);
            $totalminute = $totalminute%=60;
            $totalhours += $count;
        }
        if($user->role == 1){
            $totalhours += floor($totalminute/60)+3;
            $note_tag = "";
            $count = 0;
            $notes = array_unique($notes);
            foreach ($notes as $note){
                $note_tag = $note_tag . $note;
                if (count($notes) == 1){
                    $note_tag = $note_tag;
                    break;
                }
                if ($count == count($notes)-1){
                    break;
                }
                else{
                    if ($count == count($notes)){
                        $note_tag = $note_tag;
                        break;
                    }
                    else{
                        $note_tag = $note_tag . "+";
                        $count += 1;
                    }
                }
            }
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhours += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分".'(含社長三小時)'; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分"."(含社長三小時+$note_tag)"; 
                }
            $money = $totalhours*$basesalary;
        }
        else{
            $totalhours += floor($totalminute/60);
            $note_tag = "含";
            $count = 0;
            $notes = array_unique($notes);
            foreach ($notes as $note){
                $note_tag = $note_tag . $note;
                if (count($notes) == 1){
                    $note_tag = $note_tag;
                    break;
                }
                if ($count == count($notes)-1){
                    break;
                }
                else{
                    if ($count == count($notes)){
                        $note_tag = $note_tag;
                        break;
                    }
                    else{
                        $note_tag = $note_tag . "+";
                        $count += 1;
                    }
                }
            }
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhours += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分"; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分" ."($note_tag)"; 
                } 
            $money = $totalhours*$basesalary;
        }
        $totalmoneys["$user->id"] = $money;
        $hourtags["$user->id"] = $totalhours;
        return view('punch.show', ['basesalary'=>$basesalary,'user'=>$user,'punches'=>$punches,'date'=>$date,'nameid'=>$id,'text'=>$text,'totalmoneys'=>$totalmoneys,'hourtags'=>$hourtags]);
    }

    public function date($date){
        $date = DateTime::createFromFormat('md', $date);
        $date = $date->format('n/j');
        $punches = Punch::Where('year',date('Y'))->Where('date',$date)->latest()->get();
        $users = User::Where('role','<>','2')->orderBy('id','asc')->get();
        $tags = [];
        foreach ($users as $user){
            if($user->name == "管理員")
                continue;
            $tags["$user->id"] = $user->name;
        }
        return view('punch.create', ['punches'=>$punches,'tags'=>$tags,'state'=>1]);
    }

    public function create(){
        $punches = Punch::Where('year',date('Y'))->Where('date',date('n/j'))->latest()->get();
        $users = User::Where('role','<>','2')->orderBy('id','asc')->get();
        $tags = [];
        foreach ($users as $user){
            if($user->name == "管理員")
                continue;
            $tags["$user->id"] = $user->name;
        }
        return view('punch.create', ['punches'=>$punches,'tags'=>$tags,'state'=>0]);
    }

    public function createuserdata(){
        $punches = Punch::Where('year',date('Y'))->latest()->get();
        $users = User::Where('role','<>','2')->orderBy('id','asc')->get();
        $tags = [];
        foreach ($users as $user){
            if($user->name == "管理員")
                continue;
            $tags["$user->id"] = $user->name;
        }
        return view('punch.create2', ['punches'=>$punches,'tags'=>$tags]);
    }

    public function createuserdata1($id){
        $punches = Punch::Where('year',date('Y'))->Where('nameid',$id)->latest()->get();
        $user = User::findOrFail($id);
        $tags = [];
        $tags["$user->id"] = $user->name;
        return view('punch.create2', ['punches'=>$punches,'tags'=>$tags]);
    }

    public function edit($id,$state){
        $punch = Punch::where('id',$id)->first();
        $selectPunch_in = $punch->punch_in;
        $selectPunch_out = $punch->punch_out;
        $selectPunch_note = $punch->note;

        return view('punch.edit',['punch'=>$punch,'state'=>$state,'selectPunch_in'=>$selectPunch_in,'selectPunch_out'=>$selectPunch_out,'selectPunch_note'=>$selectPunch_note]);
    }

    public function update($id,Request $request){
        $punch = Punch::findOrFail($id);
        $month = substr($punch->date,0,2);
        $punch->punch_in = $request->input('punch_in');
        $punch->punch_out = $request->input('punch_out');
        $punch->note = $request->input('note');
        $hour1 = intval(substr($punch->punch_in,0,2));
        $hour2 = intval(substr($punch->punch_out,0,2));
        $minute1 = intval(substr($punch->punch_in,3,5));
        $minute2 = intval(substr($punch->punch_out,3,5));
        $totalhour = $hour2-$hour1;
        $totalminute = $minute2-$minute1;
        if($totalhour > 0 && $totalminute < 0){
            $totalhour -= 1;
            $totalminute = 60+$totalminute;
        }
        if($totalhour < 0){
            $totalhour = 0;
            $totalminute = 0;
        }
        if($totalminute < 0)
            $totalminute = 0;
        if($totalminute >= 50 && $totalminute <= 59){
            $totalminute = 0;
            $totalhour += 1;
        }
        if($totalminute >= 1 && $totalminute <= 10)
            $totalminute = 0;
        $punch->time = strval($totalhour)."時".strval($totalminute)."分";
        if($request->state == "2"){
            $punch->mark = 0;
        }
        else{
            $punch->mark = 1;
        }
        $punch->save();
        if ($request->state == "1" || $request->state == "2"){
            return redirect()->action([PunchController::class, 'create']);
        }
        else{
            return redirect()->action([PunchController::class, 'show'],['id'=>$punch->nameid,'month'=>$month]);
        }
    }

    public function month(Request $request){
        $punches = Punch::Punch($request->input('month'))->where('nameid',$request->input('nameid'))->latest()->get();
        $user = User::Where('id',$request->input('nameid'))->first();
        $basesalary = Basesalary::first();
        $basesalary = $basesalary->basesalary;
        $hours = [];
        $minutes = [];
        $totalhours = 0;
        $totalminute = 0;
        $totalmoneys = [];
        $hourtags = [];
        $notes = [];
        foreach($punches as $punch){
            if ($punch->note != null){
                array_push($notes,$punch->note);
            }
            array_push($hours,substr($punch->time,0,1));
            array_push($minutes,mb_substr($punch->time,2,2));
        }
        foreach($minutes as $minute){
            $totalminute += intval($minute);
        }
        foreach($hours as $hour){
            $totalhours += intval($hour);
        }
        $totalminute = $totalminute%=60;
        if($user->role == 1){
            $totalhours += floor($totalminute/60)+3;
            $note_tag = "";
            $count = 0;
            $notes = array_unique($notes);
            foreach ($notes as $note){
                $note_tag = $note_tag . $note;
                if (count($notes) == 1){
                    $note_tag = $note_tag;
                    break;
                }
                if ($count == count($notes)-1){
                    break;
                }
                else{
                    if ($count == count($notes)){
                        $note_tag = $note_tag;
                        break;
                    }
                    else{
                        $note_tag = $note_tag . "+";
                        $count += 1;
                    }
                }
            }
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhours += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分".'(含社長三小時)'; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分"."(含社長三小時+$note_tag)"; 
                }
            $money = $totalhours*$basesalary;
        }
        else{
            $totalhours += floor($totalminute/60);
            $note_tag = "含";
            $count = 0;
            $notes = array_unique($notes);
            foreach ($notes as $note){
                $note_tag = $note_tag . $note;
                if (count($notes) == 1){
                    $note_tag = $note_tag;
                    break;
                }
                if ($count == count($notes)-1){
                    break;
                }
                else{
                    if ($count == count($notes)){
                        $note_tag = $note_tag;
                        break;
                    }
                    else{
                        $note_tag = $note_tag . "+";
                        $count += 1;
                    }
                }
            }
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhours += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            if (count($notes)==0){
                    $text = $totalhours . "時" . $totalminute . "分"; 
                }
                else{
                    $text = $totalhours . "時" . $totalminute . "分" ."($note_tag)"; 
                } 
            $money = $totalhours*$basesalary;
        }
        $totalmoneys["$user->id"] = $money;
        $hourtags["$user->id"] = $totalhours;
        return view("punch.show",['basesalary'=>$basesalary,'user'=>$user,'punches'=>$punches,'selectname'=>$request->input('name'),'date'=>$request->input('month'),'text'=>$text,'nameid'=>$request->input('nameid'),'totalmoneys'=>$totalmoneys,'hourtags'=>$hourtags]);
    }

    public function store(Request $request){
        if (Auth::check()) {
            $date = $request->input('date');
            $month = substr($date,5,2);
            $day = substr($date,8,2);
            if(substr($month,0,1)=='0')
                $month = substr($month,1,1);
            if(substr($day,0,1)=='0')
                $day = substr($day,1,1);
            $hour1 = intval(substr($request->input('punch_in'),0,2));
            $hour2 = intval(substr($request->input('punch_out'),0,2));
            $minute1 = intval(substr($request->input('punch_in'),3,5));
            $minute2 = intval(substr($request->input('punch_out'),3,5));
            $totalhour = $hour2-$hour1;
            $totalminute = $minute2-$minute1;
            if($totalhour > 0 && $totalminute < 0){
                $totalhour -= 1;
                $totalminute = 60+$totalminute;
            }
            if($totalhour < 0){
                $totalhour = 0;
                $totalminute = 0;
            }
            if($totalminute < 0)
                $totalminute = 0;
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhour += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            $punch = Punch::create([
                'year' => date('Y'),
                'date' => $month.'/'.$day,
                'nameid' => $request->input('name'),
                'punch_in' => $request->input('punch_in'),
                'punch_out' => $request->input('punch_out'),
                'time' => strval($totalhour)."時".strval($totalminute)."分",
                'mark' => 1,
                'note' => $request->input('note'),
            ]);   
        }
        else{
            $cradID = ucfirst($request->input('cardID'));
            $user = User::where('cardID',$cradID)->first();
            if($user != null){
                $check = Punch::Where('year',date('Y'))->Where('nameid',$user->id)->latest()->first();
                if($check == null){
                    $punch_in = null;
                    $punch_out = null;
                }
                else{
                    $punch_in = $check->punch_in;
                    $punch_out = $check->punch_out;
                }
                if($punch_in == null || ($punch_in != null && $punch_out != null)){
                    $punch = Punch::create([
                        'year' => date('Y'),
                        'date' => date('n/j'),
                        'nameid' => $user->id,
                        'punch_in' => date("H:i")
                    ]);
                }
                else{
                    $punch = Punch::findOrFail($check->id);
                    $punch->punch_out = date("H:i");
                    $punch->save();
                    $hour1 = intval(substr($punch->punch_in,0,2));
                    $hour2 = intval(substr($punch->punch_out,0,2));
                    $minute1 = intval(substr($punch->punch_in,3,5));
                    $minute2 = intval(substr($punch->punch_out,3,5));
                    $totalhour = $hour2-$hour1;
                    $totalminute = $minute2-$minute1;
                    if($totalhour > 0 && $totalminute < 0){
                        $totalhour -= 1;
                        $totalminute = 60+$totalminute;
                    }
                    if($totalhour < 0){
                        $totalhour = 0;
                        $totalminute = 0;
                    }
                    if($totalminute < 0)
                        $totalminute = 0;
                    if($totalminute >= 50 && $totalminute <= 59){
                        $totalminute = 0;
                        $totalhour += 1;
                    }
                    if($totalminute >= 1 && $totalminute <= 10)
                        $totalminute = 0;
                    $punch->time = strval($totalhour)."時".strval($totalminute)."分";
                    $punch->save();
                }
            }
            else{
                $user = User::where('studentID',$cradID)->first();
                if($user == null) 
                    return redirect('punch/create')->with('success', '查無卡號，請重試，或使用學號');
                else{
                    $check = Punch::Where('year',date('Y'))->Where('nameid',$user->id)->latest()->first();
                    if($check == null){
                        $punch_in = null;
                        $punch_out = null;
                    }
                    else{
                        $punch_in = $check->punch_in;
                        $punch_out = $check->punch_out;
                    }
                    if($punch_in == null || ($punch_in != null && $punch_out != null)){
                        $punch = Punch::create([
                            'year' => date('Y'),
                            'date' => date('n/j'),
                            'nameid' => $user->id,
                            'punch_in' => date("H:i")
                        ]);
                    }
                    else{
                        $punch = Punch::findOrFail($check->id);
                        $punch->punch_out = date("H:i");
                        $punch->save();
                        $hour1 = intval(substr($punch->punch_in,0,2));
                        $hour2 = intval(substr($punch->punch_out,0,2));
                        $minute1 = intval(substr($punch->punch_in,3,5));
                        $minute2 = intval(substr($punch->punch_out,3,5));
                        $totalhour = $hour2-$hour1;
                        $totalminute = $minute2-$minute1;
                        if($totalhour > 0 && $totalminute < 0){
                            $totalhour -= 1;
                            $totalminute = 60+$totalminute;
                        }
                        if($totalhour < 0){
                            $totalhour = 0;
                            $totalminute = 0;
                        }
                        if($totalminute < 0)
                            $totalminute = 0;
                        if($totalminute >= 50 && $totalminute <= 59){
                            $totalminute = 0;
                            $totalhour += 1;
                        }
                        if($totalminute >= 1 && $totalminute <= 10)
                            $totalminute = 0;
                        $punch->time = strval($totalhour)."時".strval($totalminute)."分";
                        $punch->save();
                    }
                }   
            }
        }
        return redirect('punch/create');
    }

    public function store2(Request $request){
        if (Auth::check()) {
            $date = $request->input('date');
            $month = substr($date,5,2);
            $day = substr($date,8,2);
            if(substr($month,0,1)=='0')
                $month = substr($month,1,1);
            if(substr($day,0,1)=='0')
                $day = substr($day,1,1);
            $hour1 = intval(substr($request->input('punch_in'),0,2));
            $hour2 = intval(substr($request->input('punch_out'),0,2));
            $minute1 = intval(substr($request->input('punch_in'),3,5));
            $minute2 = intval(substr($request->input('punch_out'),3,5));
            $totalhour = $hour2-$hour1;
            $totalminute = $minute2-$minute1;
            if($totalhour > 0 && $totalminute < 0){
                $totalhour -= 1;
                $totalminute = 60+$totalminute;
            }
            if($totalhour < 0){
                $totalhour = 0;
                $totalminute = 0;
            }
            if($totalminute < 0)
                $totalminute = 0;
            if($totalminute >= 50 && $totalminute <= 59){
                $totalminute = 0;
                $totalhour += 1;
            }
            if($totalminute >= 1 && $totalminute <= 10)
                $totalminute = 0;
            $note = $request->input('note');
            $punch = Punch::create([
                'year' => date('Y'),
                'date' => $month.'/'.$day,
                'nameid' => $request->input('name'),
                'punch_in' => $request->input('punch_in'),
                'punch_out' => $request->input('punch_out'),
                'time' => strval($totalhour)."時".strval($totalminute)."分",
                'mark' => 1,
                'note' => $note
            ]);   
        }
        else{
            $cradID = ucfirst($request->input('cardID'));
            $user = User::where('cardID',$cradID)->first();
            if($user != null){
                $check = Punch::Where('year',date('Y'))->Where('nameid',$user->id)->latest()->first();
                if($check == null){
                    $punch_in = null;
                    $punch_out = null;
                }
                else{
                    $punch_in = $check->punch_in;
                    $punch_out = $check->punch_out;
                }
                if($punch_in == null || ($punch_in != null && $punch_out != null)){
                    $punch = Punch::create([
                        'year' => date('Y'),
                        'date' => date('n/j'),
                        'nameid' => $user->id,
                        'punch_in' => date("H:i")
                    ]);
                }
                else{
                    $punch = Punch::findOrFail($check->id);
                    $punch->punch_out = date("H:i");
                    $punch->save();
                    $hour1 = intval(substr($punch->punch_in,0,2));
                    $hour2 = intval(substr($punch->punch_out,0,2));
                    $minute1 = intval(substr($punch->punch_in,3,5));
                    $minute2 = intval(substr($punch->punch_out,3,5));
                    $totalhour = $hour2-$hour1;
                    $totalminute = $minute2-$minute1;
                    if($totalhour > 0 && $totalminute < 0){
                        $totalhour -= 1;
                        $totalminute = 60+$totalminute;
                    }
                    if($totalhour < 0){
                        $totalhour = 0;
                        $totalminute = 0;
                    }
                    if($totalminute < 0)
                        $totalminute = 0;
                    if($totalminute >= 50 && $totalminute <= 59){
                        $totalminute = 0;
                        $totalhour += 1;
                    }
                    if($totalminute >= 1 && $totalminute <= 10)
                        $totalminute = 0;
                    $punch->time = strval($totalhour)."時".strval($totalminute)."分";
                    $punch->save();
                }
            }
            else{
                $user = User::where('studentID',$cradID)->first();
                if($user == null) 
                    return redirect('punch/create')->with('success', '查無卡號，請重試，或使用學號');
                else{
                    $check = Punch::Where('year',date('Y'))->Where('nameid',$user->id)->latest()->first();
                    if($check == null){
                        $punch_in = null;
                        $punch_out = null;
                    }
                    else{
                        $punch_in = $check->punch_in;
                        $punch_out = $check->punch_out;
                    }
                    if($punch_in == null || ($punch_in != null && $punch_out != null)){
                        $punch = Punch::create([
                            'year' => date('Y'),
                            'date' => date('n/j'),
                            'nameid' => $user->id,
                            'punch_in' => date("H:i")
                        ]);
                    }
                    else{
                        $punch = Punch::findOrFail($check->id);
                        $punch->punch_out = date("H:i");
                        $punch->save();
                        $hour1 = intval(substr($punch->punch_in,0,2));
                        $hour2 = intval(substr($punch->punch_out,0,2));
                        $minute1 = intval(substr($punch->punch_in,3,5));
                        $minute2 = intval(substr($punch->punch_out,3,5));
                        $totalhour = $hour2-$hour1;
                        $totalminute = $minute2-$minute1;
                        if($totalhour > 0 && $totalminute < 0){
                            $totalhour -= 1;
                            $totalminute = 60+$totalminute;
                        }
                        if($totalhour < 0){
                            $totalhour = 0;
                            $totalminute = 0;
                        }
                        if($totalminute < 0)
                            $totalminute = 0;
                        if($totalminute >= 50 && $totalminute <= 59){
                            $totalminute = 0;
                            $totalhour += 1;
                        }
                        if($totalminute >= 1 && $totalminute <= 10)
                            $totalminute = 0;
                        $punch->time = strval($totalhour)."時".strval($totalminute)."分";
                        $punch->save();
                    }
                }   
            }
        }
        return redirect()->back();
    }

    public function destroy($id,$punchid){
        $punch = Punch::findOrFail($punchid);
        $punch->delete();

        return redirect()->back();
    }

}
