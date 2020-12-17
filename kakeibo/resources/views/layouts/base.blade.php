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
                <a class="item active">kakeibo</a>
                <a class="item">定期収支</a>
                <div class="right menu">
                    <a class="ui item">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="ui inverted segment">
        <div class="ui center aligned container">
            {{-- リンクにする --}}
            <h2>kakeibo</h2>
        </div>
    </div>
    <div class="ui container">
        @yield('content')     
    </div>
</body>
</html>