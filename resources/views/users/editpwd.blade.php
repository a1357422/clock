@if ($login == true && $user->id == Auth::user()->id)
@extends('app')

@section('title', '修改資料')

@section('dormitorysystem_theme', '修改管理員系統')

@section('dormitorysystem_contents')
@include('message.list')
{!! Form::model($user, ['method'=>'PATCH', 'action'=>['\App\Http\Controllers\UsersController@updatepwd', $user->id]]) !!}
@include ('users.form1',['submitButtonText'=>"更新資料"])
{!! Form::close()!!}
@endsection
@else
<meta http-equiv="refresh" content="0;url={{ '/punch/create' }}">
@endif