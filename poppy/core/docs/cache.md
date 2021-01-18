# 缓存约定

缓存使用扁平化管理, 缓存函数是在 laravel 的基础上加了一层标签, 用法遵循 laravel 缓存使用

缓存一般采用如下命名

```
sys_cache('{slug}')->get('{type}.{func}')
slug    : 根据模块目录来进行判定
    例如 poppy system 模块命名为 py-system
    例如 poppy core 模块命名为 py-core
    例如 poppy core rbac 模块命名为 py-core-rbac(因为需要用到 flush 方法, 这里采用标签来区分, 而不是使用 type)
type    : 代表的是模块类型
    例如 module,api
func    : 代表功能部分
    例如 模块的 menus, 模块的 module 功能
```