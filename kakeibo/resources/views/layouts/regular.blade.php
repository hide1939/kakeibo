@extends('layouts.base')

@section('title', '定期収支登録')

@section('content')
<div class="ui placeholder segment">
    <div class="ui icon header">
        <h2>定期収支の合計</h2>
        <div class="ui centered cards">
            <div class="card">
                <div class="content">
                    <h1>{{ $regular_total_amount }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="ui placeholder segment">
    <div class="ui center aligned icon header">
        {{ Form::open(['url' => '/regular?param=e']) }}
            <div class="ui huge form">
                <h3>支出</h3>
                @error('item')
                    <div class="ui red message">{{ $message }}</div>
                @enderror
                @error('amount')
                    <div class="ui red message">{{ $message }}</div>
                @enderror
                <div class="two fields">
                    <div class="field">
                        {{ Form::input('text', 'item', '', ['placeholder' => '項目名'])}}
                    </div>
                    <div class="field">
                        {{ Form::input('text', 'amount', '', ['placeholder' => '金額'])}}
                    </div>
                </div>
                <button type="submit" class="positive large ui button">登録</button>
            </div>
        {{ Form::close() }}
        <br>
        {{ Form::open(['url' => '/regular?param=i']) }}
            <div class="ui huge form">
                <h3>収入</h3>
                @error('item')
                    <div class="ui red message">{{ $message }}</div>
                @enderror
                @error('amount')
                    <div class="ui red message">{{ $message }}</div>
                @enderror
                <div class="two fields">
                    <div class="field">
                        {{ Form::input('text', 'item', '', ['placeholder' => '項目名'])}}
                    </div>
                    <div class="field">
                        {{ Form::input('text', 'amount', '', ['placeholder' => '金額'])}}
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
    @foreach ($regular_expenses as $regular_expense)
    <tbody>
        <tr>
            <td data-label="Name">{{ $regular_expense->item }}</td>
            <td data-label="Age">{{ $regular_expense->amount }}</td>
            <td data-label="Job">
                {{ Form::open(['method' => 'DELETE', 'url' => '/regular?param=e&id=' . $regular_expense->id]) }}
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
    @foreach ($regular_incomes as $regular_income)
    <tbody>
        <tr>
            <td data-label="Name">{{ $regular_income->item }}</td>
            <td data-label="Age">{{ $regular_income->amount }}</td>
            <td data-label="Job">
                {{ Form::open(['method' => 'DELETE', 'url' => '/regular?param=i&id=' . $regular_income->id]) }}
                {{ Form::submit('削除') }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
<br>
@endsection