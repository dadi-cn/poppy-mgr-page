let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Web Url : https://laravel-mix.com
 |--------------------------------------------------------------------------
 */
mix
    .browserSync({
        // 这里替换地址
        proxy : 'http://poppy.duoli.com/',
        files : [
            "public/assets/**/*.js",
            "public/assets/**/*.css",
            "modules/**/src/request/**/*.php",
            "modules/**/resources/views/**/*.blade.php",
            "modules/**/resources/js/**/*.js"
        ]
    })
    .options({
        processCssUrls : false
    })
    .disableNotifications()
    .version()
    /* 开发使用[便于文件加载]
     * ---------------------------------------- */
    // develop
    .less(
        'resources/assets/app/web.less',
        'public/app/css/web.css'
    )
    .less(
        'resources/assets/poppy/less/mgr-page.less',
        'public/assets/libs/boot/style.css'
    )
    .scripts([
            'resources/assets/poppy/libs/poppy/util.js',
            'resources/assets/poppy/libs/poppy/cp.js',
            'resources/assets/poppy/libs/poppy/mgr-page/cp.js'
        ],
        'public/assets/libs/boot/poppy.mgr.min.js'
    )
    .scripts([
            'resources/assets/poppy/libs/jquery/2.2.4/jquery.min.js',
            'resources/assets/poppy/libs/jquery/form/jquery.form.js',
            'resources/assets/poppy/libs/jquery/pjax/jquery.pjax.js',
            'resources/assets/poppy/libs/jquery/poshytip/jquery.poshytip.js',
            'resources/assets/poppy/libs/jquery/validation/jquery.validation.js',
            'resources/assets/poppy/libs/jquery/drag-arrange/drag-arrange.js',
            'resources/assets/poppy/libs/jquery/tokenize2/jquery.tokenize2.js',
            'resources/assets/poppy/libs/clipboard/clipboard.min.js'
        ],
        'public/assets/libs/boot/vendor.min.js'
    )
    .copyDirectory('poppy/mgr-page/resources/font/', 'public/assets/font/')
    .copyDirectory('poppy/mgr-page/resources/images/', 'public/assets/images/')
    .copyDirectory('poppy/mgr-page/resources/libs/jquery/', 'public/assets/libs/jquery/')
    .copyDirectory('poppy/mgr-page/resources/libs/easy-web/', 'public/assets/libs/easy-web')
    .copyDirectory('poppy/mgr-page/resources/libs/layui/', 'public/assets/libs/layui')
    .copyDirectory('poppy/mgr-page/resources/libs/vue/', 'public/assets/libs/vue')
    .copyDirectory('poppy/mgr-page/resources/libs/underscore/', 'public/assets/libs/underscore');