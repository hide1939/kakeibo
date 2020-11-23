<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>定期収支登録</title>
</head>
<body>
    <div>
        <p>定期収支を登録する画面です</p>
        <p>定期収支の合計↓</p>
        <p>{{ $regular_total_amount }}</p>
        <p>定期収入の項目と金額</p>
        @foreach ($regular_expenses as $regular_expense)
        <ul>
            <li>{{ $regular_expense->item }}</li>
            <li>{{ $regular_expense->amount }}</li>
        </ul>
        @endforeach
        <p>定期支出の項目と金額</p>
        @foreach ($regular_incomes as $regular_income)
        <ul>
            <li>{{ $regular_income->item }}</li>
            <li>{{ $regular_income->amount }}</li>
        </ul>
        @endforeach
    </div>
</body>
</html>