@extends('web.inc.tpl_react')
@section('tpl-main')
    <div id="app">
        {{--替换内容--}}
    </div>
    <script>
        var Title = React.createClass({
            propTypes : {
                name: React.PropTypes.string.isRequired
            },
            getDefaultProps: function(){
                return {
                    name: 'Wende'
                }
            },
            render:function(){
                return  React.DOM.span(null, 'Its a Custom Title : ' + this.props.name);
            }
        });

        ReactDOM.render(
            React.DOM.h1({
                id       : "first_heading",
                className: 'first_heading',
                htmlFor  : 'me',
                style    : {
                    fontSize  : '12px',
                    fontWeight: 'bold',
                    fontStyle : 'normal'
                }
            }, React.createElement(Title, {
                name: "555"
            })),
            document.getElementById('app')
        )

    </script>
@endsection