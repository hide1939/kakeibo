@extends('layouts.base')

@section('title', 'メイン画面')

@section('head_info')
<meta name="api-token" content="{{ Auth::user()->api_token }}">
@endsection

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
        <div id="expense_income_form">
            {{-- TODO:入力欄とボタンを横並びにしたい(semantic uiのgrid?) --}}
            {{-- この中にReactによりボタンとexpenseかincomeのフォームが入る --}}
        </div>
    </div>
</div>
<br>
<div id="expense_income_table">
    {{-- 収支のテーブルを表示する --}}
</div>
<br>
@endsection
@section('js_script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection