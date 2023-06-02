@extends('app')

@section('title', '打卡紀錄管理')

@section('dormitorysystem_theme', '')

@section('dormitorysystem_contents')
<div class="function">
    <div class="maintitle_btn">
        <h3>打卡紀錄管理</h3>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <tr class='column_center'>
            <th>工讀生姓名</th>
            <th>{{$date}}月總時數</th>
            <th>詳細資料</th>
        </tr>
        @foreach($users as $user)
        <tr class='column_center'>
            <td align="center" valign="center">{{ $user->name }}</td>
            <td align="center" valign="center">{{ $tags[$user->id] }}</td>
            <td>
            <font color=blue><a href="{{ route('punch.show',['id'=>$user->id]) }}" class="btn btn-primary">詳細資料</a></font>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection