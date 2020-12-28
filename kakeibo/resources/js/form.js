import React from 'react';
import ReactDOM from 'react-dom';

// formのコンポーネントを読み込む
import ExpenseForm from './components/expense_form.js';
import IncomeForm from './components/income_form.js';

// 取得できるidによって表示させるフォームを分ける
if (document.getElementById('expense_form')) {
    ReactDOM.render(<ExpenseForm />, document.getElementById('expense_form'));
}
if (document.getElementById('income_form')) {
    ReactDOM.render(<IncomeForm />, document.getElementById('income_form'));
}
