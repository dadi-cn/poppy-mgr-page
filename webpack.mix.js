/*
 * Copyright (C) 2013-2017 Shandong Liexiang Tec, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
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
    .sass(
        'poppy/mgr-page/resources/scss/style.scss',
        'public/assets/libs/boot/style.css'
    )
    .combine([
            'poppy/mgr-page/resources/libs/poppy/util.js',
            'poppy/mgr-page/resources/libs/poppy/cp.js',
            'poppy/mgr-page/resources/libs/poppy/mgr-page/cp.js'
        ],
        'public/assets/libs/boot/poppy.mgr.min.js'
    )
    .combine([
            'poppy/mgr-page/resources/libs/simditor/module.js',
            'poppy/mgr-page/resources/libs/simditor/hotkeys.js',
            'poppy/mgr-page/resources/libs/simditor/uploader.js',
            'poppy/mgr-page/resources/libs/simditor/simditor.js'
        ],
        'public/assets/libs/boot/simditor.min.js'
    )
    .combine([
            'poppy/mgr-page/resources/libs/jquery/2.2.4/jquery.min.js',
            'poppy/mgr-page/resources/libs/jquery/form/jquery.form.js',
            'poppy/mgr-page/resources/libs/jquery/pjax/jquery.pjax.js',
            'poppy/mgr-page/resources/libs/jquery/poshytip/jquery.poshytip.js',
            'poppy/mgr-page/resources/libs/jquery/validation/jquery.validation.js',
            'poppy/mgr-page/resources/libs/clipboard/clipboard.min.js'
        ],
        'public/assets/libs/boot/vendor.min.js'
    )
    .copy('poppy/mgr-page/resources/libs/simditor/simditor.css', 'public/assets/libs/boot/simditor.css')
    .copyDirectory('poppy/mgr-page/resources/font/', 'public/assets/font/')
    .copyDirectory('poppy/mgr-page/resources/images/', 'public/assets/images/')
    .copyDirectory('poppy/mgr-page/resources/libs/jquery/backstretch/', 'public/assets/libs/jquery/backstretch')
    .copyDirectory('poppy/mgr-page/resources/libs/jquery/tokenize2/', 'public/assets/libs/jquery/tokenize2')
    .copyDirectory('poppy/mgr-page/resources/libs/drag-arrange/', 'public/assets/libs/drag-arrange')
    .copyDirectory('poppy/mgr-page/resources/libs/easy-web/', 'public/assets/libs/easy-web')
    .copyDirectory('poppy/mgr-page/resources/libs/layui/', 'public/assets/libs/layui')
    .copyDirectory('poppy/mgr-page/resources/libs/vue/', 'public/assets/libs/vue')
    .copyDirectory('poppy/mgr-page/resources/libs/underscore/', 'public/assets/libs/underscore');