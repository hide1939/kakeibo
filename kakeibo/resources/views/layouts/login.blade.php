@extends('layouts.base')

@section('title', 'ログイン')

@section('content')
<div>ログイン画面だよ</div>
{{ Form::open(['url' => '/login']) }}
{{ Form::label('name', '名前') }}
{{ Form::input('text', 'name')}}
{{ Form::label('email', 'email') }}
{{ Form::email('email') }}
{{ Form::label('password', 'パスワード') }}
{{ Form::password('password') }}
{{ Form::submit('送信') }}
{{ Form::close() }}
@endsection