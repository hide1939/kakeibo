@extends('layouts.base')

@section('title', 'ログイン')

@section('content')
<br>
<h2>ログイン</h2>
<br>
{{ Form::open(['url' => '/login', 'method' => 'post', 'class' => 'ui fluid form']) }}
    <div class="field">
        <div class="ui pointing below label">名前</div>
        @error('name')
            <div class="ui red message">{{ $message }}</div>
        @enderror
        {{ Form::input('text', 'name', '', ['placeholder' => 'name']) }}
    </div>
    <div class="field">
        <div class="ui pointing below label">メールアドレス</div>
        @error('email')
            <div class="ui red message">{{ $message }}</div>
        @enderror
        {{ Form::email('email', '', ['placeholder' => 'email']) }}
    </div>
    <div class="field">
        <div class="ui pointing below label">パスワード</div>
        @error('password')
            <div class="ui red message">{{ $message }}</div>
        @enderror
        {{ Form::password('password') }}
    </div>
    <div class="ui checkbox">
        <input type="checkbox" name="remember_me" value=1>
        <label>ログイン状態を保存する</label>
    </div>
    <div></div>
    <br>
    <button type="submit" class="positive large ui button">ログイン</button>
{{ Form::close() }}
@endsection