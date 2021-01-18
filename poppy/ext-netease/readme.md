## 如何使用

### 如何安装

### 如何使用

**1. 类如何使用**

```php
use Poppy\Extension\Netease\Im\ImClient;

$Im = new ImClient();
$Im->setAppKey('key')->setAppSecret('secret');
$data = [
];
$Im->addFriend($data);
```

**2. 包如何测试**

```json
{
	"key": "xxxx",
	"secret": "xxx"
}
```