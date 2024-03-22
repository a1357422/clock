@extends('app')

@section('title', '打卡紀錄管理')

@section('dormitorysystem_theme', '')

@section('dormitorysystem_contents')
<div class="function no-print">
    <div class="maintitle_btn">
        <h3 class="custom-heading">{{$date}}月打卡紀錄管理</h3>
    </div>
</div>
<div class="form-container no-print">
    <form action="{{ url('punch/record') }}" method='GET'>
        {!! Form::label('month', '月份：') !!}
        {!! Form::select('month', array('1' => '1月' , '2' => '2月', '3' => '3月', '4' => '4月', '5' => '5月', '6' => '6月', '7' => '7月', '8' => '8月', '9' => '9月', '10' => '10月', '11' => '11月', '12' => '12月'),$date,['onchange' => 'submit()']) !!}
        <input type="submit" value="查詢" class="btn btn-secondary" style="display: none;"/>
        @guest
        <font color=blue><a href="{{ route('punch.create') }}" class="btn btn-secondary">新增打卡紀錄</a></font>
        @else
        <font color=blue><a href="{{ route('punch.createuserdata')}}" class="btn btn-secondary">新增打卡紀錄</a></font>
        <button class="btn btn-success" onclick="printTable()">列印</button>
        @endguest
    </form>
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
        @if ($user->role == 2)
            @continue
        @endif
        <tr class='column_center print-section'>
            <td align="center" valign="center">{{ $user->name }}</td>
            <td align="center" valign="center">{{ $tags[$user->id] }}</td>
            <td align="center" valign="center">{{$hourtags[$user->id]}}*{{$basesalary}} = {{ $totalmoneys[$user->id] }}元</td>
            <td>
            <font color=blue><a href="{{ route('punch.show',['id'=>$user->id,'month'=>$date]) }}" class="btn btn-primary no-print">詳細資料</a></font>
            </td>
        </tr>
        @endforeach
        <tr class='column_center no-print'>
            <td/>
            <td align="center" valign="center"> <strong> 總薪資：</strong></td>
            <td align="center" valign="center"> <strong> {{$total}}元</strong></td>
            <td/>
        </tr>
    </table>
</div>
<script>
    function printTable() {
        window.print();
    }
</script>
@endsection