# 配置(Config)

### Seo

```
// 用于设置后台网站名称 和 描述信息
'title'       => '网站名称',
'description' => '网站描述',
```

### 信息模板

```
// 根据执行内容显示不同的视图模板(例成功/失败)
// 接收视图地址 如 module::xx.folder.message  可支持多个视图地址
'message_template' => [
],
```

### 配置信息

```
'framework' => [
    // 页数 
    'page_size'        => 15,

    // 最大页数
    'page_max'         => 3000,

    // 根据执行内容显示不同的模板
    'message_template' => [

    ],

    // Seo 相关
    'title'            => '网站名称',
],
```