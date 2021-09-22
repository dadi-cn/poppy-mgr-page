# Poppy Sms 扩展包

## 安装

```
composer require poppy/sms 3.2.* 
```

## 安装附加扩展

因为此扩展包仅仅为了封装 poppy framework 使用, 并没有附带的 composer 包, 所以需要功能正确执行, 需要自行安装

**Aliyun**

```
    ...
    "alibabacloud/client": "^1.5",
    "alibabacloud/dysmsapi": "1.8.*",
    ...
```

## 更新相关包或者重新安装

更新你的依赖包 `composer update` 或者全新安装 `composer install`。