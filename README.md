## 本项目用来开发 Poppy 扩展

### 开发流程

将扩展放置到 poppy 目录下进行开发

```
cd poppy
git clone https://codeup.aliyun.com/dadi/poppy/ad.git
git clone https://codeup.aliyun.com/dadi/poppy/aliyun-oss.git
git clone https://codeup.aliyun.com/dadi/poppy/aliyun-push.git
git clone https://codeup.aliyun.com/dadi/poppy/area.git
git clone https://codeup.aliyun.com/dadi/poppy/canal-es.git
git clone https://codeup.aliyun.com/dadi/poppy/core.git
git clone https://codeup.aliyun.com/dadi/poppy/ext-alipay.git
git clone https://codeup.aliyun.com/dadi/poppy/ext-ip_store.git
git clone https://codeup.aliyun.com/dadi/poppy/ext-pinyin.git
git clone https://codeup.aliyun.com/dadi/poppy/ext-wxpay.git
git clone https://codeup.aliyun.com/dadi/poppy/faker.git
git clone https://codeup.aliyun.com/dadi/poppy/framework.git
git clone https://codeup.aliyun.com/dadi/poppy/mgr-page.git
git clone https://codeup.aliyun.com/dadi/poppy/sensitive-word.git
git clone https://codeup.aliyun.com/dadi/poppy/sms.git
git clone https://codeup.aliyun.com/dadi/poppy/system.git
git clone https://codeup.aliyun.com/dadi/poppy/version.git

git clone git@github.com:imvkmark/poppy-faker.git faker
```

### Todo(3.0)

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

### Poppy 文件注入配置

1. poppy.php
2. module.php
3. ext.php

```
# Poppy
poppy.framework.page_max

# 模块配置
module.order.xxx
```

#### Poppy 改动

```
# 配置信息
-	poppy.pages.default_size
+	poppy.framework.page_size

-	poppy.pages.max_size
+	poppy.framework.page_max
```

### 系统设置

扩展的配置文件配置命名使用

```
# 扩展的命名
ext-aliyun::push.access_key

# 组件设置
py-system::permission.prefix

# 模块设置
order::over.hour
```

