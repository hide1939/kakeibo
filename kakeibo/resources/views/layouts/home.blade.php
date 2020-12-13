@extends('layouts.base')

@section('title', 'kakeibo')

@section('content')
<a href="/regist">新規登録</a>
<a href="/login">ログイン</a>



<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="search icon"></i>
    We don't have any documents matching your query
  </div>
  <div class="inline">
    <div class="ui primary button">Clear Query</div>
    <div class="ui button">Add Document</div>
  </div>
</div>
@endsection