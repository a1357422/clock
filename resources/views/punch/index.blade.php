@extends('app')

@section('title', '打卡紀錄管理')

@section('dormitorysystem_theme', '')

@section('dormitorysystem_contents')
<div class="function">
    <div class="maintitle_btn">
        <h3>打卡紀錄管理</h3>
    </div>
</div>
@if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
@endif
<div class="form-container">
    <font color=blue><a href="{{ route('punch.create') }}" class="btn btn-secondary">新增打卡紀錄</a></font>
</div>
<div class="table-responsive">
    <table class="table">
        <tr class='column_center'>
            <th>工讀生姓名</th>
            <th>{{$date}}月總時數</th>
            <th>薪資試算(時薪{{$basesalary}})</th>
            <th>詳細資料</th>
        </tr>
        @foreach($users as $user)
        <tr class='column_center'>
            <td align="center" valign="center">{{ $user->name }}</td>
            <td align="center" valign="center">{{ $tags[$user->id] }}</td>
            <td align="center" valign="center">{{$hourtags[$user->id]}}*{{$basesalary}} = {{ $totalmoneys[$user->id] }}元</td>
            <td>
            <font color=blue><a href="{{ route('punch.show',['id'=>$user->id]) }}" class="btn btn-primary">詳細資料</a></font>
            </td>
        </tr>
        @endforeach
        <tr class='column_center'>
            <td/>
            <td align="center" valign="center"> <strong> 總薪資：</strong></td>
            <td align="center" valign="center"> <strong> {{$total}}元</strong></td>
        </tr>
    </table>
</div>
@endsection