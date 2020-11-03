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
            {{ Form::submit() }}
        {{ Form::close() }}
    </div>
    <script src="js/app.js"></script>
</body>
</html>