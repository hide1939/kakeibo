import React from 'react';

class Form extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            title: '支出',
            uri: '/main?param=e'
        }
        this.setExpenseValue = this.setExpenseValue.bind(this);
        this.setIncomeValue = this.setIncomeValue.bind(this);
    }

    setExpenseValue() {
        this.setState({
            title: '支出',
            uri: '/main?param=e'
        });
    }

    setIncomeValue() {
        this.setState({
            title: '収入',
            uri: '/main?param=i'
        });
    }

    render() {
        return (
            <>
                <div className="ui buttons">
                    <button className="ui button active" onClick={this.setExpenseValue}>支出</button>
                    <div className="or"></div>
                    <button className="ui positive button" onClick={this.setIncomeValue}>収入</button>
                </div>
                <form action={ this.state.uri } method="post">
                    {/* <input type="hidden" name="_token" value={csrf_token} /> */}
                    <div className="ui huge form">
                    <h3>{ this.state.title }</h3>
                        <div className="two fields">
                            <div className="field">
                                <input type="text" name="item" placeholder="項目名" />
                            </div>
                            <div className="field">
                                <input type="number" name="amount" placeholder="金額" />
                            </div>
                        </div>
                        <button type="submit" className="positive large ui button">登録</button>
                    </div>
                </form>
            </>
        );
    }
}

export default Form;