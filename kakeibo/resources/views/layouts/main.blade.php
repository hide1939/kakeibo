@extends('layouts.base')

@section('title', 'メイン画面')

@section('head_info')
<meta name="api-token" content="{{ Auth::user()->api_token }}">
@endsection

@section('content')
<div id="main">
</div>
@endsection
@section('js_script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection