@extends('web.inc.tpl_react')
@section('tpl-main')
    <div id="app">
        {{--替换内容--}}
    </div>
    <script>
        var TextAreaCounter = React.createClass({
            propTypes      : {
                defaultValue: React.PropTypes.string
            },
            getDefaultProps: function () {
                return {
                    defaultValue: 'Wende'
                }
            },
            // 获取初始状态, 保证总是合法的获取到数据, 这里写把获取到的值复制到状态中更容易理解
            getInitialState: function () {
                return {
                    text: this.props.defaultValue
                }
            },
            render         : function () {
                return React.DOM.div(
                    null,
                    React.createElement('textarea', {
                        defaultValue: this.state.text,
                        onChange    : this._textChange
                    }),
                    React.DOM.h3(null, this.state.text.length)
                );
            },
            // 文本改变的时候更新状态值
            // 从而渲染的时候可以同步更新
            _textChange    : function (ev) {
                this.setState({
                    text: ev.target.value
                })
            }
        });

        myTextAreaController = ReactDOM.render(
            React.createElement(TextAreaCounter, {
                defaultValue: 'Bob'
            }),
            document.getElementById('app')
        )

    </script>
@endsection