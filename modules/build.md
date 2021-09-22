## 3.x

### 3.2

- 放开 laravel 6.0 的限制至 6.*
- php 最低限制 7.4
- composer 版本 2.*

### 3.1

3.0 涵盖的项目

- framework
- system
- rbac
- 前后端分离


- 支持前后端分离
- 支持安装
- 支持权限分离
- 去除 Addon 加载
- 支持 poppy/文件夹配置
- Ali推送支持配置访问
- 支持 manifest 文件扫描配置用于加载
- 分离数据库和 system 模块
- 扩展使用 ext.php 文件来加载配置,降低层级加载
- 分离 rbac -> core
- 分离 module -> core
- 取消 composer 之外的文件加载
- 强类型

**Poppy 文件注入配置**

1. poppy.php
2. module.php
3. ext.php

```
# Poppy
poppy.framework.page_max

# 模块配置
module.order.xxx
```

**Poppy 改动**

```
# 配置信息
-	poppy.pages.default_size
+	poppy.framework.page_size

-	poppy.pages.max_size
+	poppy.framework.page_max
```

**系统设置**

扩展的配置文件配置命名使用

```
# 扩展的命名
ext-aliyun::push.access_key

# 组件设置
py-system::permission.prefix

# 模块设置
order::over.hour
```