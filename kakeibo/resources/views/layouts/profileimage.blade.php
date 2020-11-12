<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール画像登録</title>
</head>
<body>
    <div>
        <p>プロフィール画像投稿フォーム</p>
        {{ Form::open(['url' => '/profile_image', 'files' => true]) }}
            {{ Form::token() }}
            {{ Form::file('profile_image') }}
            {{ Form::submit('更新する') }}
        {{ Form::close() }}

        <div>プロフィール画像</div>
        <img src="{{ asset('storage/profile_image/' . $profile_image_path) }}" width="300px" height="300px" alt="プロフィール画像">
        <img src="{{ asset('storage/profile_image/default.png') }}" width="300px" height="300px" alt="プロフィール画像">
    </div>
    <script src="js/app.js"></script>
</body>
</html>