<div class="wuli--box box-header_lighten">
    <h3>导航</h3>
    <div class="box-links">
        <div class="box-links_group">
            <h4>格式化</h4>
            <div class="box-links_items">
                <a class="J_ignore {!! active_class(if_uri_pattern('*format/xml')) !!}"
                   href="{!! route('site:tool.format', ['xml']) !!}">Xml 格式化</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*format/json')) !!}"
                   href="{!! route('site:tool.format', ['json']) !!}">Json 格式化</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*format/sql')) !!}"
                   href="{!! route('site:tool.format', ['sql']) !!}">Sql 格式化</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*format/css')) !!}"
                   href="{!! route('site:tool.format', ['css']) !!}">Css 格式化</a>
            </div>
        </div>
        <div class="box-links_group">
            <h4>Api</h4>
            <div class="box-links_items">
                <a class="J_ignore {!! active_class(if_uri_pattern('*apidoc')) !!}"
                   href="{!! route('site:tool.apidoc') !!}">Json To Apidoc 注释</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*entity')) !!}"
                   href="{!! route('site:tool.html_entity') !!}">Html实体转换</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*ssl_key')) !!}"
                   href="{!! route('site:tool.ssl_key') !!}">RSA 密钥转换</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*md_extend')) !!}"
                   href="{!! route('site:tool.md_extend') !!}">MarkDown参数增强</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*man_to_md')) !!}"
                   href="{!! route('site:tool.man_to_md') !!}">Man -> Markdown</a>
            </div>
        </div>
        <div class="box-links_group">
            <h4>Socket</h4>
            <div class="box-links_items">
                <a class="J_ignore {!! active_class(if_uri_pattern('*centrifuge')) !!}"
                   href="{!! route('fe:web.centrifuge.index') !!}">Centrifuge V1</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*centrifuge/v2')) !!}"
                   href="{!! route('fe:web.centrifuge.index', ['v2']) !!}">Centrifuge V2</a>
                <a class="J_ignore {!! active_class(if_uri_pattern('*ws')) !!}"
                   href="{!! route('fe:web.ws.index') !!}">WebSocket</a>
            </div>
        </div>
    </div>
</div>