import React from 'react';

class ExpenseForm extends React.Component {
    render() {
        return (
            // expense form
            <form action="/main?param=e" method="post">
                <div class="ui huge form">
                    <h3>支出</h3>
                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="item" placeholder="項目名" />
                        </div>
                        <div class="field">
                            <input type="number" name="amount" placeholder="金額" />
                        </div>
                    </div>
                    <button type="submit" class="positive large ui button">登録</button>
                </div>
            </form>
        );
    }
}

export default ExpenseForm;