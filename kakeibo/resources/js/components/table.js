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
            .then((response) => {
                this.setState({
                    month_expenses: response.data.month_expenses,
                    month_incomes: response.data.month_incomes
                });
            })
            .catch((error) => {
                console.log('error');
            })
            .then(() => {
                console.log('always executed');
            })
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
        );
    }
}

export default Table;