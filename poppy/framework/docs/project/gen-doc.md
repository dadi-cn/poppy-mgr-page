# 文档生成

**发布**

文档使用 `php artisan vendor:publish --force --tag=poppy-docs` 发布, 如果不想强制覆盖, 可以去掉 `--force` 选项

**说明**

项目文档使用 [docsify.js](https://docsify.js.org/#/zh-cn/quickstart) 生成, cdn 地址参考 https://www.bootcdn.cn/docsify/, 用以获取插件支持

**运行**

文档使用 `php -S 0.0.0.0:8848 -t resources/docs` 内建服务器运行
