@extends('layouts.base')

@section('title', 'プロフィール画像')

@section('content')
<p>プロフィール画像投稿フォーム</p>
{{ Form::open(['url' => '/profile_image', 'files' => true]) }}
    {{ Form::token() }}
    {{ Form::file('profile_image') }}
    {{ Form::submit('更新する') }}
{{ Form::close() }}

<p>プロフィール画像</p>
<img src="{{ asset('storage/profile_image/' . $profile_image_path) }}" width="300px" height="300px" alt="プロフィール画像">
@endsection