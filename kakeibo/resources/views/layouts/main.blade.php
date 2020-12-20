@extends('layouts.base')

@section('title', 'メイン画面')

@section('content')
<div class="ui placeholder segment">
    <div class="ui icon header">
        <h2>{{ $year }}年{{ $month }}月</h2>
        <div class="ui centered cards">
            <div class="card">
                <div class="content">
                    <h1>{{ $month_total_amount }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="ui placeholder segment">
    <div class="ui center aligned icon header">
        {{-- TODO:入力欄とボタンを横並びにしたい(semantic uiのgrid?) --}}
        <div class="ui buttons">
            <button class="ui button active">支出</button>
            <div class="or"></div>
            <button class="ui positive button">収入</button>
        </div>
        {{ Form::open(['url' => '/main?param=e']) }}
            <div class="ui huge form">
                <h3>支出</h3>
                <div class="two fields">
                    <div class="field">
                        {{ Form::input('text', 'item', '', ['placeholder' => '項目名'])}}
                    </div>
                    <div class="field">
                        {{ Form::input('number', 'amount', '', ['placeholder' => '金額'])}}
                    </div>
                </div>
                <button type="submit" class="positive large ui button">登録</button>
            </div>
        {{ Form::close() }}
        <br>
        {{ Form::open(['url' => '/main?param=i']) }}
            <div class="ui huge form">
                <h3>収入</h3>
                <div class="two fields">
                    <div class="field">
                        {{ Form::input('text', 'item', '', ['placeholder' => '項目名'])}}
                    </div>
                    <div class="field">
                        {{ Form::input('number', 'amount', '', ['placeholder' => '金額'])}}
                    </div>
                </div>
                <button type="submit" class="positive large ui button">登録</button>
            </div>
        {{ Form::close() }}
    </div>
</div>
<br>
<table class="ui celled table">
    <thead>
        <tr>
            <th>支出</th>
            <th>金額</th>
            <th></th>
        </tr>
    </thead>
    @foreach ($month_expenses as $month_expense)
    <tbody>
        <tr>
            <td data-label="Name">{{ $month_expense->item }}</td>
            <td data-label="Age">{{ $month_expense->amount }}</td>
            <td data-label="Job">
                {{ Form::open(['method' => 'DELETE', 'url' => '/main?param=e&id=' . $month_expense->id]) }}
                {{ Form::submit('削除') }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
    @endforeach
    <thead>
        <tr>
            <th>収入</th>
            <th>金額</th>
            <th></th>
        </tr>
    </thead>
    @foreach ($month_incomes as $month_income)
    <tbody>
        <tr>
            <td data-label="Name">{{ $month_income->item }}</td>
            <td data-label="Age">{{ $month_income->amount }}</td>
            <td data-label="Job">
                {{ Form::open(['method' => 'DELETE', 'url' => '/main?param=i&id=' . $month_income->id]) }}
                {{ Form::submit('削除') }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
<br>
@endsection