import React from 'react';
import axios from 'axios';

class Main extends React.Component {
    constructor(props) {
        super(props);
        let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
        let api_token = document.head.querySelector('meta[name="api-token"]').content;
        this.state = {
            // この辺のデフォルト値は適切な値にしたい
            title: '支出',
            param: 'e',
            month_expenses: [],
            month_incomes: [],
            csrf_token: csrf_token,
            api_token: api_token,
            month_total_amount: 0,
            year: '',
            month: '',
            item_value: '',
            amount_value: ''
        };
        this.setExpenseValue = this.setExpenseValue.bind(this);
        this.setIncomeValue = this.setIncomeValue.bind(this);
        this.postValue = this.postValue.bind(this);
        this.handleItemChange = this.handleItemChange.bind(this);
        this.handleAmountChange = this.handleAmountChange.bind(this);
    }

    // 表示するデータを取得する
    componentDidMount() {
        // TODO:将来的に年月のparameterも渡せるようにする
        axios.get('api/main', {
            params: {
                api_token: this.state.api_token
            }
        })
            .then((response) => {
                this.setState({
                    month_total_amount: response.data.month_total_amount,
                    month_expenses: response.data.month_expenses,
                    month_incomes: response.data.month_incomes,
                    year: response.data.year,
                    month: response.data.month
                });
            })
            .catch((error) => {
                console.log('error');
            })
            .then(() => {
                console.log('always executed');
            })
    }

    handleItemChange(event) {
        this.setState({
            item_value: event.target.value
        });
    }

    handleAmountChange(event) {
        this.setState({
            amount_value: event.target.value
        });
    }

    // フォーム入力したデータをpostして登録する
    postValue() {
        if (this.state.param == 'e') {
            this.setState({
                month_total_amount: this.state.month_total_amount -= this.state.amount_value
            })
        }
        if (this.state.param == 'i') {
            this.setState({
                month_total_amount: this.state.month_total_amount += parseInt(this.state.amount_value)
            })
        }

        axios.post('api/main?' + 'param=' + this.state.param + '&api_token=' + this.state.api_token, {
            item: this.state.item_value,
            amount: this.state.amount_value
        })
        .then((response) => {
            // テーブルを更新する 
            this.componentDidMount();
            // フォームにセットしたデータを消す
            this.setState({
                item_value: '',
                amount_value: ''
            });
        })
        .catch((response) => {
            console.log('cant post data');
        })
    }

    setExpenseValue() {
        this.setState({
            title: '支出',
            param: 'e'
        });
    }

    setIncomeValue() {
        this.setState({
            title: '収入',
            param: 'i'
        });
    }

    render() {
        const { month_expenses, month_incomes } = this.state;
        const month_expenses_block = month_expenses.map(month_expense => {
            return (
                <tbody>
                    <tr>
                        <td data-label="Name">{ month_expense.item }</td>
                        <td data-label="Age">{ month_expense.amount }</td>
                        <td data-label="Job">
                            <form action={ '/main?param=e&id=' + month_expense.id } method='delete'>
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            );
        });
        const month_incomes_block = month_incomes.map(month_income => {
            return (
                <tbody>
                    <tr>
                        <td data-label="Name">{ month_income.item }</td>
                        <td data-label="Age">{ month_income.amount }</td>
                        <td data-label="Job">
                            <form action={ '/main?param=i&id=' + month_income.id } method='delete'>
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            );
        });

        return (
            <>
                <div className="ui placeholder segment">
                    <div className="ui icon header">
                        <h2>{ this.state.year }年{ this.state.month }月</h2>
                        <div className="ui centered cards">
                            <div className="card">
                                <div className="content">
                                    <h1>{ this.state.month_total_amount }</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div className="ui placeholder segment">
                    <div className="ui center aligned icon header">
                        {/* TODO:入力欄とボタンを横並びにしたい(semantic uiのgrid?) */}
                        <div className="ui buttons">
                            <button className="ui button active" onClick={ this.setExpenseValue }>支出</button>
                            <div className="or"></div>
                            <button className="ui positive button" onClick={ this.setIncomeValue }>収入</button>
                        </div>
                        <form>
                            <input type="hidden" name="_token" value={ this.state.csrf_token } />
                            <div className="ui huge form">
                                <h3>{ this.state.title }</h3>
                                <div className="two fields">
                                    <div className="field">
                                        <input type="text" name="item" placeholder="項目名" value={ this.state.item_value } onChange={ this.handleItemChange } />
                                    </div>
                                    <div className="field">
                                        <input type="number" name="amount" placeholder="金額" value={ this.state.amount_value } onChange={ this.handleAmountChange } />
                                    </div>
                                </div>
                                <button type="button" className="positive large ui button" onClick={ this.postValue }>登録</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br />
                <table className="ui celled table">
                    <thead>
                        <tr>
                            <th>支出</th>
                            <th>金額</th>
                            <th></th>
                        </tr>
                    </thead>
                    { month_expenses_block }
                    <thead>
                        <tr>
                            <th>収入</th>
                            <th>金額</th>
                            <th></th>
                        </tr>
                    </thead>
                    { month_incomes_block }
                </table>
                <br />
            </>
        );
    }
}

export default Main;