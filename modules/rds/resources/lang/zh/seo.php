<?php
/*
|--------------------------------------------------------------------------
| 自动 seo
|--------------------------------------------------------------------------
| slt:nav.index  => slt::seo.nav_index
| 也就是 key 就是 路由名称的转换, 里边需要有
| title       : 标题(没有默认为网站名称)
| description : 描述(没有默认是网站描述, 有则替换, 以后可能加入替换项目)
*/
return [
	'nav_index'     => [
		'title' => '导航',
	],
	'fe_js'         => [
		'title' => 'Js示例',
	],
	'book_my'       => [
		'title' => '我的文库',
	],
	'book_show'     => [
		'title' => '文库',
	],
	'article_show'  => [
		'title' => '文章',
	],
	'user_login'    => [
		'title' => '登录',
	],
	'user_register' => [
		'title' => '注册',
	],

	'slt'                    => '',
	'tool_index'             => '工具',
	'tool_format'            => '格式化',
	'tool_apidoc'            => '生成 apidoc 注释',
	'util_image'             => '',
	'fe_md'                  => '',
	'fe_images'              => '',
	'user_forgot_password'   => '',
	'user_profile'           => '',
	'user_nickname'          => '',
	'user_avatar'            => '',
	'user_logout'            => '',
	'nav_jump'               => '',
	'nav_jump_user'          => '',
	'nav_collection'         => '',
	'nav_collection_destroy' => '',
	'nav_url'                => '',
	'nav_url_destroy'        => '',
	'nav_fetch_title'        => '',
	'nav_tag'                => '',
	'book_establish'         => '',
	'article_create'         => '',
	'article_popup'          => '',
	'article_establish'      => '',
	'article_destroy'        => '',
	'image_upload'           => '',

];