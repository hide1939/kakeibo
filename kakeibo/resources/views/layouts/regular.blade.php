<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>定期収支登録画面</title>
</head>
<body>
    <div>
        <header>
            <div>kakeibo</div>
        </header>
        <div>
            <p>定期収支の合計</p>
            <p>{{ $regular_total_amount }}円</p>
        </div>
        <div>
            <p>定期支出</p>
            {{ Form::open(['url' => '/regular?param=e']) }}
            {{ Form::label('item', '支出項目') }}
            {{ Form::input('text', 'item')}}
            {{ Form::label('amount', '支出金額') }}
            {{ Form::input('number', 'amount')}}
            {{ Form::submit('送信') }}
            {{ Form::close() }}
            <p>-------------------</p>
            <p>定期収入</p>
            {{ Form::open(['url' => '/regular?param=i']) }}
            {{ Form::label('item', '収入項目') }}
            {{ Form::input('text', 'item')}}
            {{ Form::label('amount', '収入金額') }}
            {{ Form::input('number', 'amount')}}
            {{ Form::submit('送信') }}
            {{ Form::close() }}
        </div>
        <div>
            <p>定期支出の項目と金額</p>
            @foreach ($regular_expenses as $regular_expense)
            <ul>
                <li>{{ $regular_expense->item }}</li>
                <li>{{ $regular_expense->amount }}</li>
                {{ Form::open(['method' => 'DELETE', 'url' => '/regular?param=e&id=' . $regular_expense->id]) }}
                {{ Form::submit('削除') }}
                {{ Form::close() }}
            </ul>
            @endforeach
            <p>定期収入の項目と金額</p>
            @foreach ($regular_incomes as $regular_income)
            <ul>
                <li>{{ $regular_income->item }}</li>
                <li>{{ $regular_income->amount }}</li>
                {{ Form::open(['method' => 'DELETE', 'url' => '/regular?param=i&id=' . $regular_income->id]) }}
                {{ Form::submit('削除') }}
                {{ Form::close() }}
            </ul>
            @endforeach
        </div>
    </div>
</body>
</html>