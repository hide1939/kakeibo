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
            <button class="ui button active" onclick="expense()">支出</button>
            <div class="or"></div>
            <button class="ui positive button" onclick="income()">収入</button>
        </div>
        <div id="expense_income_form">
            {{-- この中にexportかincomeのフォームが入る --}}
        </div>
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