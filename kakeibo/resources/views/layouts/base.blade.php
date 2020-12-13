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
    <div class="ui inverted segment">
        <div class="ui center aligned container">
            <h2>kakeibo</h2>
        </div>
    </div>
    <div class="ui container">
        @yield('content')     
    </div>
    <div class="ui inverted segment">
        <div class="ui center aligned container">
            <h2>kakeibo</h2>
        </div>
    </div>
</body>
</html>