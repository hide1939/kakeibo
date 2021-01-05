import React from 'react';
import axios from 'axios';

class Table extends React.Component {
    constructor(props) {
        super(props);
        let api_token = document.head.querySelector('meta[name="api-token"]');
        this.state = {
            month_expenses: [],
            month_incomes: [],
            api_token: api_token.content
        }
    }

    // getリクエストでメイン画面でtableに表示するjsonデータを取得する
    componentDidMount() {
        axios.get('api/main', {
            params: {
                api_token: this.state.api_token
            }
        })
            .then(function (response) {
                // stateに取得したjson配列をセット
                this.setState({
                    month_expenses: response.data.month_expenses,
                    month_incomes: response.data.month_incomes
                });
            })
            .catch(function (error) {
                console.log('error');
            })
            .then(function () {
                console.log('always executed');
            })
    }

    // ループ処理でテーブルを表示する
    render() {
        const { month_expenses, month_incomes } = this.state;
        $month_expenses_block = month_expenses.map(month_expense => {

        });
        return (
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>支出</th>
                        <th>金額</th>
                        <th></th>
                    </tr>
                </thead>
                {/* @foreach ($month_expenses as $month_expense) */}
                <tbody>
                    <tr>
                        <td data-label="Name">{{ $month_expense->item }}</td>
                        <td data-label="Age">{{ $month_expense->amount }}</td>
                        <td data-label="Job">
                            <form action='/main?param=e&id=' . $month_expense->id method='delete'></form>
                                <button type="submit">削除</button>
                            </form>
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
                            <form action='/main?param=i&id=' . $month_income->id method='delete'></form>
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        );
    }
}

export default Table;