# PHP - 编码规范 v1.6

## 一、命名规则

### 1.命名规则概要

1)	使用含义丰富的名字

```php
// good
if ($currentYear > 2009) ...

// bad
if($t > 2009) ...	
```

2)	在缩写中,只将首字母大写

```
// good
function getHttpHost()

// bad
function getHTTPHost()	
```

### 2.	类命名

1)	类应该以名词单数形式, 首字母大写, 大小写混排,方式命名

```
class SqlStatement {	...	}
```

2)	表示一组事物的类应使用复数形式

```
class SqlStatements {	...	} 
```

3)	类型放置在结尾
      对一个已知类型的变量还有同类变量我们采用尾部后缀来识别不同的类.

```
class ConnectionError extends Error {
    // ...	
} 
```

4)	接口的默认实现类可以以 Default 开头

```
class DefaultSqlBuilder extends SqlBuilderContract {
    //...	
} 
```

### 3.	接口命名


接口的名字应为以单词 `Contract` 作为后缀, 以表明这是约束,或者是放入到文件夹中, 使用包名 来进行约束

```
interface SqlEngineContract{}	

interface SortableContract{}
```

```php
<?php namespace Poppy\Core\Rbac\Contracts;

interface RbacPermissionContract
{
	// ...
}
```

### 4.	变量/属性命名

1)	属性名应以小写字母开头, 采用驼峰法则.

```
public $userAuth;
```

3)	常量的名字必须全部为大写字母
      所有字母大写，单词之间用下划线分割

```
const SEARCH_GOOGLE = 1;	
const SEARCH_YAHOO  = 2;
```

4)	命名一组对象时,应使用复数形式

```
public $books;
```

5)	布尔型变量不应使用否定性名字

```
// good
public $isFound;	
public $isEnough;

// bad
public $isNotFound;	
public $isNotEnough;
```

6)	在嵌套循环中,使用有意义丰富的名字来命名循环控制变量

```
// good
for($row = 0; $row < getRows();$row++) {    
    for($col= 0;$col < getCols(); $col++) {
        // ...	
    }	
}

// bad
for($i = 0; $i < getRows();$i++) {
    for($j= 0;$j < getCols(); $j++){
        // ...	
    }	
}
```

7) 传入的变量采用蛇形写法, 自定义函数变量采用蛇形写法

```
// 控制器变量
class UserController extends Controller{
    function login(Request $request) {
        // 这里是蛇形写法
        $order_status = $request->input('order_status');
    }
}

// 自定义函数变量
// 这里传入的变量采用蛇形写法
function route_url($route, $params, $option_params){
    // ...
}
```

8) 同名称的不同类型使用匈牙利命名法则来区分

```
$arrCatids = array(1,2,3,4,5,6);
$strCatids = '1,2,3,4,5,6'; 
```

### 5.	函数命名
禁止拼音命名法

1)	类函数名称以小写字母开头, 采用驼峰法则

```
function getCurrentYear()
```

2)	用动词命名函数

```
// 动词表：
lists/ establish / delete / destroy
begin / end
first / last 
get / release
get / set
increment / decrement
put / get
lock / unlock 
open / close
min / max 
old / new 
start / stop
next / previous 
source / target 
show / hide
send / receive
cut / paste 
up / down

// 系词表:
is / has
```

```
function startDatabase()
function getDatabaseStatus()
```

3)	函数名字可以忽略类或对象名称,以避免重复

```
// good
class Font {
    function getFamily();
}

// bad
class Font {	
    function getFontFamily();
}
```

4)	单例类应该通过一个名为getInstance()的静态函数返回他们唯一的值

```
class Toolkit {	
	private static const toolkit = new Toolkit();
	public static function getInstance(){
		return toolkit; 
	}	
} 
```



## 二、文件格式/ 技巧

### 1. 缩进

代码使用 `空格` 缩进, 缩进采用 4 空格长度

### 2.	留白

恰当的使用空格可以有效提高代码的可读性

1)	使用空格的通用规则
1.	操作符 `:`(冒号), `+`(加号) 的前后都应有一个空格.
2.	操作符 `,`(逗号) 之后须有一个空格

```php
// good
$bit = $bitStart + $bitEnd;
case 'someStr' :
mysqlConnection($config, $dbname);
if($count > 9)

// bad
$bit=$bitStart+$bitEnd;	
case 'someStr':	
mysqlConnection($config,$dbname);
if($count>9)	
```

2)	逻辑单元应该以空行分割

```php
function drawCapture() {	
    $chars = getChars(5);
    
    // imageCreate
    $img = imageCreate();
    
    // output image
    outputImage();	
} 
```

### 3.	控制流程
1)	for,while,if语句格式如下

```php
// for
for (init; condition; update) {    
    // ...	
} 

// while
while (condition) {	
    // ...	
} 

// if
if (condition) {
    // ...	
} 
elseif (condition) {	
    // ...	
} 
else {
    // ...	
} 
```

2)	循环/条件语句必须以 `{` , `}`嵌套

```php
// good
if ($i > 0) {
    $val ++;	
}
for ($i = 0; $i < $size; $i++) {    
    $val ++;	
}

// bad 
for($i=0; $i<$size; $i++)	$val ++;
if($i > 0)	$val ++;
```

3)	使用临时变量以避免复合条件语句

```php
// good
$itemValid = $itemMoney > 800 && $level > 3 && $valid > 0;
if($itemValid && isReady()) {
    display();	
}

// bad
if($itemMoney > 800 && $level > 3 && $valid > 0 && isReady()) {
    display();	
}
```

4)	Switches 语句应该套用以下格式,并且每个分支必须注释清楚

```
switch (condition) {
    case 0 :	        
    // show something
        break;	
    default :
    // this is some code
}
```

### 4.	声明

1)	类/接口声明顺序
      类文档中的语句的顺序.

```
1.	文档/注释
2.	类/接口语句
3.	常量
4.	静态变量顺序:[public, protected, private]
5.	实例变量顺序:[public, protected, private]
6.	构造函数 __construct();
7.	函数 [public, protected, private] function();
```

2)	变量的声明要在代码块的开头,而不是在用到它们的地方

```
public function method() {
    $value = 0;
    ...	
    for (...) {	
        $value += $num;	
    }	
} 
```

3) 变量需要先声明再使用

变量在使用前必须要初始化, 如果不初始化则会报错

```php
// bad
foreach ($items as $item) {
	$cash_over[]       = $item->cash_over;
}

return view('desktop.finance_real.index', [
	'cash_over'       => $cash_over,
]);

// good
$cash_over = [];
foreach ($items as $item) {
	$cash_over[]       = $item->cash_over;
}

return view('desktop.finance_real.index', [
	'cash_over'       => $cash_over,
]);
```

### 5.	技巧

1) 删除文件尾部的 `?>`

php文件的典型标记是以 `<?php` 开头， `?>` 结尾。但是在 Zend Framework 中却不推荐在php文件末尾加 `?>`
因为在`<?php ?>`之外的任何字符都会被输出到网页上，而之中的却不会。所以在末尾不加 `?>` 可以预防 php 文件被恶意加入字符输出到网页。

2) 数组的键名

在PHP中, 使用不经单引号包含的字符串作为数组键名是合法的, 但是我们不希望如此 -- 键名应该总是由单引号包含而避免引起混淆. 注意这是使用一个字符串, 而不是使用变量做键名的情况

```
// 错误	
$foo = $assoc_array[blah];
// 正确
$foo = $assoc_array['blah'];
// 错误
$foo = $assoc_array["$var"];
// 正确	
$foo = $assoc_array[$var]; 
```

3) 不要使用未初始化的变量

```
// 错误	
if ($forum) ...
// 正确
if (isset($forum)) ...
// 正确	
if (isset($forum) && $forum == 5) 
```

4) 避免在大数组上使用 in_array

避免在大的数组上使用 `in_array()`, 同时避免在循环中对包含200个以上元素的数组使用这个函数. `in_array()` 会非常消耗资源. 对于小的数组这种影响可能很小, 但是在一个循环中检查大数组可能会需要好几秒钟的时间. 如果您确实需要这个功能, 请使用isset()来查找数组元素. 实际上是使用键名来查询键值. 调用 `isset($array[$var])` 会比 `in_array($var, array_keys($array))` 要快得多.

5) SQL 脚本格式

SQL 代码常常会变得很长, 如果不作一定的格式规范, 将很难读懂. SQL代码一般按照以下的格式书写, 以关键字换行:

```php
$sql = 'SELECT * 	
<-one tab->FROM ' . SOME_TABLE . ' 
<-one tab->WHERE a = 1 
<-two  tabs->AND (b = 2 
<-three tabs->OR b = 3) 	
<-one tab->ORDER BY b'; 
```

这里是应用了制表符后的例子:

```
$sql = 'SELECT *
    FROM ' . SOME_TABLE . ' 
    WHERE a = 1 
        AND (b = 2 
            OR b = 3) 	   
    ORDER BY b'; 	
```

6) 禁止使用单字母开头的变量(无意义的变量)

```
$tKey, $tVal
```


### 6. 空行的使用

1) `<?php [namespace]` 之后必须有1个空行

```php
<?php namespace System\Rbac\Helper;

use Illuminate\Database\Eloquent\Collection;

class RbacHelper{ /*...*/ }
```

2) 两个函数之间至少有1个空行。
3) return、die、exit 之前如果有其他语句的情况下应加上一个空行

## 三、文档与注释

### 1.	PHPDoc

PHPDoc 是一个 PHP 版的 Javadoc。它是一种注释 PHP 代码的正式标准。它支持通过类似 phpDocumentor 这样的外部文档生成器生成 API 文档，也可以帮助一些例如 Zend Studio, NetBeans, ActiveState Komodo Edit and IDE 和 Aptana Studio 之类的 集成开发环境 理解变量类型和弱类型语言中的其他歧义并提供改进的代码完成，类型提示和除错功能。
参考地址: http://zh.wikipedia.org/zh/PHPDoc

### 2.	注释

1) 类注释

```
/**
 * 这是某个类的介绍
 */	
class SomeClass{}
```

2) 注释局部变量

```
function someFunction(){
    /** @var int $result 获取到的结果集 */
    $result = 0;      
    
    /** array $searchResult 获取到的搜索结果集*/
    var $searchResult;
    
    // ...
}
```


3) 注释类变量

```
/** 
 * The description of name
 * @var string 
 */
public $name 
```

4) 注释函数
   注释的标记应按照以下顺序

```
* 	@param
* 	@return
* 	@see
```

### 3.	文档注释

```
/**
 * 文件头部说明
 * 
 * @author     Mark (zhaody901@126.com)
 * @copyright  Copyright (c) 2014-2016 sour-lemon team
 */
```
## 四、框架技巧

### 1.  控制器方法
```
lists()        # 列表
establish()    # 创建 / 编辑
update()       # 更新 / 批量更新
delete()       # 删除
destroy()      # 销毁(彻底删除)
```

### 2. 路由写法

路由器第二个参数不可以传 `key`

```
// 传值 bad
route('dsk_base_area.establish', ['parent_id' => $item['areaid']])

// 不传值 good
route('dsk_base_area.establish', [$item->areaid]])
```

这两个哪个写起来更简洁呢?
因为使用 route 的时候接收到的参数在控制器传参数进行获取
`public function establish($parent_id)` 这种方法才能够接收到数据的.
ps: 使用 `$request->input('parent_id')` 根本获取不到东西

### 3. 使用对象和对象的错误提示

```
// 使用对象的好处
route('dsk_base_area.create', [$item['areaid']])   # 如果不存在字段, 则报 undefined index 错误
route('dsk_base_area.create', [$item->area_id])    # 这里不报错的.

// 使用映射过的对象的好处是容易识记
route('dsk_base_area.create', [$item->areaid])    # 这里不报错的.
route('dsk_base_area.create', [$item->area_id])   # 使用映射过的字段更便于记忆, 减少浏览器的 `typo` 错误
```

### 4. 合理使用模型提供的方法

```
// 取一条
UserMessage::where('item_id', $item_id)->select("*")->first();
UserMessage::where('item_id', $item_id)->first();
UserMessage::find($item_id);

// 取单个
UserMessage::where('item_id', $item_id)->lists('username')->first();
UserMessage::where('item_id', $item_id)->value('username');

// 模型方法
$item = UserMessage::find($item_id);
$item->num += 1;
$item->save();
```

### 5. Form 使用 post 方法提交可以不填写 'method'

```
// 这里来自于表单提交
@if (isset($item))
    {!! Form::model($item,['route' => ['dsk_adv_item.edit', $item->id], 'id' => 'form_ad_place','method' => 'post']) !!}
@else
    {!! Form::open(['route' => 'dsk_adv_item.create','id' => 'form_ad_place','enctype'=>'multipart/form-data']) !!}
@endif
```

优化后

```
@if (isset($item))
    {!! Form::model($item,['route' => ['dsk_adv_item.edit', $item->id], 'id' => 'form_ad_place']) !!}
@else
    {!! Form::open(['route' => 'dsk_adv_item.create','id' => 'form_ad_place']) !!}
@endif
```

### 6. 对于编辑/创建使用同一个模版
编辑和创建来说, 我们使用同一个模版, 模板的名字应该命名为 `item.blade.php`

### 7. [批量]更新使用 update

因为这里的更新就是批量的, 并且使用的方式不是更新一个, 所以这里不使用 `batchUpdate`

```php
class AdPlaceController{
    // bad
    public function batchUpdate() {
        // ...
    }


    // good
    public function update() {
        $update = \Input::input('update');
        foreach ($update as $id => $item) {
            AdvPlace::where('id', $id)->update($item);
        }
        return site_end('success', '更新成功');
    }
}
```


## 附录Appendices

### 附录A:参考文档

- PHPBB 编码规范
  http://www.phpbbchina.com/wiki/index.php/PhpBB_编码规范
- Typecho PHP 编码规范
  https://code.google.com/p/typecho/wiki/TypechoPHPCoding
- 优化编写代码过程中的PHP
  http://www.yeeyan.org/articles/view/davidkoree/4409

### 附录B:PHPDoc 标签参考

在线版地址 : http://manual.phpdoc.org/HTMLSmartyConverter/PHP/phpDocumentor/tutorial_tags.pkg.html

```
@abstract		Documents an abstract class, class variable or method.
@access	public, private or protected	Documents access control for an element. @access private indicates that documentation of element be prevented.
@author	author name <author@email>	Documents the author of the current element.
@category		Specify a category to organize the documented element’s package into
@copyright	name date	Documents copyright information.
@deprecated	version	Documents a method as deprecated.
@example	/path/to/example	Documents the location of an external saved example file.
@exception		documents an exception thrown by a method — also see @throws.
@global	type $globalvarname	Documents a global variable or its use in a function or method.
@ignore		Prevents the documentation of an element
@internal		private information for advanced developers
@link	URL	
@name	global variable name	Specifies an alias for a variable. For example, $GLOBALS[‘myvariable’] becomes $myvariable
@magic		phpDocumentor tags}-.
@package	name of a package	Documents a group of related classes and functions.
@param	type [$varname] description	
@return	type description	This tag should not be used for constructors or methods defined with a void return type.
@see		Documents an association to another method or class.
@since	version	Documents when a method was added to a class.
@static		Documents a static class or method
@staticvar		Documents a static variable’s use in a function or class
@subpackage		
@throws		Documents an exception thrown by a method.
@todo		Documents things that need to be done to the code at a later date.
@var	type	a data type for a class variable
@version		Provides the version number of a class or method.
```
### 附录C: 版本变化

**v1.6(2020年12月21日)**
加入空格约定
约定接口写法
**v1.5(2018年04月29日)**
变更格式
对 interface 约定做修改
增加 Laravel 技巧
**v1.4(2016年10月07日)**
更改为markdown格式, 并且将其替换为Laravel 编码格式
**V1.3(2015年4月19日)**
项目文件结构说明
**V1.2(2013年4月27日)**
分离项目公共部分
**V1.1(2013年4月2日)**
增加左格式化内容
增加删除 `?>` 标记
**V1.0(2012年11月7日)**
初始化规范




