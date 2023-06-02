@extends('app')

@section('title', '新增資料')

@section('dormitorysystem_theme', '新增打卡資料系統')

@section('dormitorysystem_contents')
    @include('message.list')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    {!! Form::open(['url'=>'punch/store'])!!}
    @include('punch.form',['submitButtonText'=>"打卡"])
    {!! Form::close()!!}
    <table class="table">
        <tr class='column_center'>
            <th>日期</th>
            <th>工讀生姓名</th>
            <th>上班簽到時間</th>
            <th>上班簽退時間</th>
            <th>時數</th>
        </tr>
        @foreach($punches as $punch)
        @guest
        <tr class='column_center'>
            <td align="center" valign="center">{{ $punch->date }}</td>
            <td align="center" valign="center">{{ $punch->user->name }}</td>
            <td align="center" valign="center">{{ $punch->punch_in }}</td>
            <td align="center" valign="center">{{ $punch->punch_out }}</td>
            <td align="center" valign="center">{{ $punch->time }}</td>
        </tr>
        @else
        @if($punch->mark == 1)
        <tr class='column_center'>
            <td align="center" valign="center"><font color=red>{{ $punch->date }}</font></td>
            <td align="center" valign="center"><font color=red>{{ $punch->user->name }}</font></td>
            <td align="center" valign="center"><font color=red>{{ $punch->punch_in }}</font></td>
            <td align="center" valign="center"><font color=red>{{ $punch->punch_out }}</font></td>
            <td align="center" valign="center"><font color=red>{{ $punch->time }}</font></td>
        </tr>
        @endif
        @endguest
        @endforeach
    </table>
@endsection