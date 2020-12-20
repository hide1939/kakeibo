@extends('layouts.base')

@section('title', '新規登録')

@section('content')
<br>
<h2>新規登録</h2>
<br>
{{ Form::open(['url' => '/regist', 'method' => 'post', 'class' => 'ui fluid form']) }}
    <div class="field">
        <div class="ui pointing below label">名前</div>
        {{ Form::input('text', 'name', '', ['placeholder' => 'name']) }}
    </div>
    <div class="field">
        <div class="ui pointing below label">メールアドレス</div>
        {{ Form::email('email', '', ['placeholder' => 'email']) }}
    </div>
    <div class="field">
        <div class="ui pointing below label">パスワード</div>
        {{ Form::password('password') }}
    </div>
    <br>
    <button type="submit" class="positive large ui button">登録</button>
{{ Form::close() }}
@endsection