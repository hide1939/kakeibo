@extends('layouts.base')

@section('title', 'kakeibo')

@section('content')
<div class="ui placeholder segment">
  <div class="ui icon header">
    シンプルな家計簿アプリです
  </div>
  <div class="inline">
    <button class="ui inverted orange button">
        <a href="/regist">新規登録</a>
    </button>
    <button class="ui inverted blue button">
        <a href="/login">ログイン</a>
    </button>
  </div>
  <br>
  <img class="ui centered big image" src="{{ asset('storage/common/money.jpeg') }}">
</div>
@endsection