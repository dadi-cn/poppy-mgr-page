# Poppy-Ext-pinyin

Chinese to Pinyin translator for Laravel / Lumen based on [overtrue/pinyin](https://github.com/overtrue/pinyin).

## Install

```shell
composer require "poppy/ext-pinyin:3.2.x-dev"
```

## Usage


```php

$pinyin = app('poppy.ext.pinyin');
echo $pinyin->sentence('带着希望去旅行，比到达终点更美好');
// dài zhe xī wàng qù lǔ xíng, bǐ dào dá zhōng diǎn gèng měi hǎo
```

There are more convenient functions:

|  function      | method                                                |
| -------------  | --------------------------------------------------- |
| `ext_pinyin()`     | `app('poppy.ext.pinyin')->convert()`                              |
| `ext_pinyin_abbr()`     | `app('poppy.ext.pinyin')->abbr()`                                        |
| `ext_pinyin_permalink` | `app('poppy.ext.pinyin')->permalink()`                         |
| `ext_pinyin_sentence` | `app('poppy.ext.pinyin')->sentence()`                         |

```php
var_dump(ext_pinyin('带着希望去旅行，比到达终点更美好'));
// ["dai", "zhe", "xi", "wang", "qu", "lv", "xing", "bi", "dao", "da", "zhong", "dian", "geng", "mei", "hao"]

var_dump(ext_pinyin_abbr('带着希望去旅行'));
// dzxwqlx
...
```


About `overtrue/pinyin` specific configuration and use, refer to: [overtrue/pinyin](https://github.com/overtrue/pinyin)

## License

MIT
