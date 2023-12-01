<script>
    function confirmAddNote() {
        var note = document.getElementById('note').value;
        if (note.trim() === '' || note === null) {
                
        }
        return confirm('是否要新增此備註？');
    }
</script>
@extends('app')

@section('title', '修改資料')

@section('dormitorysystem_theme', '修改打卡資料系統')

@section('dormitorysystem_contents')
        @include('message.list')
        {!! Form::model($punch, ['method'=>'PATCH', 'action'=>['\App\Http\Controllers\PunchController@update', $punch->id],'onsubmit' => 'return confirmAddNote()']) !!}
        工讀生：{{ $punch->user->name }}</br>
        @include ('punch.form1',['submitButtonText'=>"更新打卡資料"])
        {!! Form::close()!!}
@endsection