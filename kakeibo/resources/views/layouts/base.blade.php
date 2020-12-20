<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="js/app.js"></script>
    {{-- semantic ui --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</head>
<body>
    @if (Auth::check())
    <div class="ui inverted segment">
        <div class="ui container">
            <div class="ui inverted secondary pointing menu">
                <a href="/" class="item active">kakeibo</a>
                <a href="/main" class="item">月の収支</a>
                <a href="/regular" class="item">定期収支</a>
                <div class="right menu">
                    <a href="#" class="ui item">{{ $login_user_name }}</a>
                    <a href="/logout" class="ui item">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="ui inverted segment">
        <div class="ui center aligned container">
            {{-- リンクにする --}}
            {{-- cssにする --}}
            <h2><a href='/' style='color:white'>kakeibo</a></h2>
        </div>
    </div>
    @endif
    <div class="ui container">
        @yield('content')   
    </div>
</body>
</html>