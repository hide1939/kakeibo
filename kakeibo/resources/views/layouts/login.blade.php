@extends('layouts.base')

@section('title', 'ログイン')

@section('content')
<br>
<h2>ログイン</h2>
<br>
{{ Form::open(['url' => '/login', 'method' => 'post', 'class' => 'ui fluid form']) }}
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
    <button type="submit" class="positive large ui button">送信</button>
{{ Form::close() }}
@endsection