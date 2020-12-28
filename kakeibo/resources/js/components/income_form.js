import React from 'react';

class IncomeForm extends React.Component {
    render() {
        return (
            // income form
            <form action="/main?param=i" method="post" >
                <div class="ui huge form">
                    <h3>収入</h3>
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

export default IncomeForm;