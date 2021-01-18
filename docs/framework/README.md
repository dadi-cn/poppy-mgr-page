# README(Zh-Cn)

项目分为两个部分, 一部分为模块, 另一部分是 Poppy 模块, 为了区分, 所以 slug 的命名分为
`module.{module}` `poppy.{poppy}`

## 命令行/Console

### 创建模块

创建一个 Poppy 模块并启动它.

```
$ php artisan poppy:make {slug} [-Q|--quick]
```

模块文件树:

```
├── configurations        # 配置文件
├── docs                  # 文档
├── resources
│   ├── lang              # 语言文件
│   │   └── zh            # 语言文件夹
│   └── views             # blade 模板
└── src
    ├── action
    ├── classes
    ├── database
    │   ├── factories
    │   ├── migrations
    │   └── seeds
    ├── events
    ├── http
    │   ├── request
    │   │   ├── api
    │   │   ├── backend
    │   │   └── web
    │   └── routes
    ├── jobs
    ├── listeners
    ├── models
    └── testing
```

### 列出 Modules

列出所有的应用模块

```
$ php artisan poppy:list

+------+------------+-------------------+----------------------------------------------------+---------+
| #    | Name       | Slug              | Description                                        | Status  |
+------+------------+-------------------+----------------------------------------------------+---------+
| 1000 | 核心       | poppy.core        | Poppy Core.                                        | Enabled |
| 9001 | site       | module.site       | This is the description for the poppy site module. | Enabled |
+------+------------+-------------------+----------------------------------------------------+---------+

```

### 启用/禁用模块

```
# 启用模块
$ php artisan poppy:enable {slug}


# 禁用模块
$ php artisan poppy:disable {slug}
```

### 优化模块

模块优化, 清空生成的缓存等操作

```
$ php artisan poppy:optimize
```

### Poppy 数据库管理

```
poppy:migrate {slug}          执行模块的数据库迁移文件
poppy:migrate:refresh {slug}  重新执行模块数据库迁移文件
poppy:migrate:reset {slug}    回滚所有执行的数据库迁移
poppy:migrate:rollback {slug} 回滚执行完的上一个数据库迁移
poppy:migration {slug}        创建一个指定模块的数据库迁移文件
```

## Poppy 生成器

生成器工具

```
php artisan poppy:command {slug} {name}           # 生成命令文件
php artisan poppy:controller {slug} {api/web/backend} {name}
                                                  # 生成控制器文件
php artisan poppy:middleware {slug} {name}        # 生成中间件文件
php artisan poppy:model {slug} {name}             # 生成数据库模型文件
php artisan poppy:policy {slug} {name}            # 生成 policy 策略文件
php artisan poppy:provider {slug} {name}          # 生成服务提供者
php artisan poppy:request {slug} {name}           # 生成 request 文件
php artisan poppy:seed {slug} {name}              # 写入种子
php artisan poppy:seeder {slug} {name}            # 生成种子文件
php artisan poppy:test {slug} {name}              # 生成测试文件
php artisan poppy:make {slug}                     # 生成模块
php artisan poppy:listener {slug} {name}          # 事件监听器(详细见下方)
php artisan poppy:event {slug} {name}             # 生成事件文件

```

### 生成模块监听类文件

```
php artisan poppy:listener {slug} {name}
--event {event}: 事件名称, 使用 `\` 表明是全局的事件, 否则的话以为这是当前模块的事件
```

### 生成模块事件类文件

```
php artisan poppy:event {slug} {name}
```

## 事件

```
// Module Maked
Events\PoppyMake($slug)

// 模块启用
Events\PoppyEnabled

// 模块禁用
Events\PoppyDisabled

// 模块优化
Events\PoppyOptimized
```

## Helpers

```
ArrayHelper
EnvHelper
FileHelper
HtmlHelper
ImageHelper
CookieHelper
RouterHelper
SearchHelper
StrHelper
TimeHelper
TreeHelper
UtilHelper
```

## 解析器

支持 Xml,Ini,Yaml

## Blade 语法

```
@poppy
// You Can check if module is exist and enabled.
@endpoppy
```

## 验证

```
1.语言包
 - resource/lang/zh/validator.php
2.相应的验证规则
 - Rule 类
3.FrameworkServiceProvider.php 验证正则规则
```

## 代码约定

开发进行提交前按照这个清单进行下检测

**PHP-CS-Fixer**
[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) is a tool to automatically fix PHP Coding Standards issues, We use it for Code
Specification.

**测试用例完善并且通过**

**注释完善并且通过**

注释使用 `poppy/core` 模块来检测[开发必备]

```
$ php artisan py-core:inspect class
```

**代码清理过**

这个指的是 IDE 进行优化导入, 选中文件夹, 然后批量进行格式化 + 优化导入

**不要出现 package 标签**

```
@package
```

## 参考 & Docs

- [Yaml](http://nodeca.github.io/js-yaml/)
- [EloquentFilter](https://github.com/Tucker-Eric/EloquentFilter)
- [Sami](https://github.com/FriendsOfPHP/Sami)
- [Carbon - 时间组件](https://segmentfault.com/a/1190000014239090)
- [Laravel Html & Form - Html/Form 封装](https://segmentfault.com/a/1190000011580448)
- [hieu-le/active-Url 状态组件](https://laravel-china.org/topics/2858/extended-recommendation-hieu-leactive-according-to-the-url-generated-corresponding-navigation-active-state)
- [hashids/hashids - 对 ID 进行 Hash 加密](https://github.com/vinkla/laravel-hashids)
