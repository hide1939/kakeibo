<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
</head>
<body>
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
</body>
</html>