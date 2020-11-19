<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録画面</title>
</head>
<body>
    <div>新規登録だよ</div>
    {{ Form::open(['url' => '/regist']) }}
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