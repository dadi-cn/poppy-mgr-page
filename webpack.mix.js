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
        'resources/assets/scss/mgr-page.scss',
        'public/assets/libs/boot/style.css'
    )
    .combine([
            'resources/assets/libs/poppy/util.js',
            'resources/assets/libs/poppy/cp.js',
            'resources/assets/libs/poppy/mgr-page/cp.js'
        ],
        'public/assets/libs/boot/poppy.mgr.min.js'
    )
    .combine([
            'resources/assets/libs/simditor/module.js',
            'resources/assets/libs/simditor/hotkeys.js',
            'resources/assets/libs/simditor/uploader.js',
            'resources/assets/libs/simditor/simditor.js'
        ],
        'public/assets/libs/boot/simditor.min.js'
    )
    .combine([
            'resources/assets/libs/jquery/2.2.4/jquery.min.js',
            'resources/assets/libs/jquery/form/jquery.form.js',
            'resources/assets/libs/jquery/pjax/jquery.pjax.js',
            'resources/assets/libs/jquery/poshytip/jquery.poshytip.js',
            'resources/assets/libs/jquery/validation/jquery.validation.js',
            'resources/assets/libs/jquery/drag-arrange/drag-arrange.js',
            'resources/assets/libs/jquery/tokenize2/jquery.tokenize2.js',
            'resources/assets/libs/clipboard/clipboard.min.js'
        ],
        'public/assets/libs/boot/vendor.min.js'
    )
    .copy('resources/assets/libs/simditor/simditor.css', 'public/assets/libs/boot/simditor.css')
    .copyDirectory('poppy/mgr-page/resources/font/', 'public/assets/font/')
    .copyDirectory('poppy/mgr-page/resources/images/', 'public/assets/images/')
    .copyDirectory('poppy/mgr-page/resources/libs/jquery/', 'public/assets/libs/jquery/')
    .copyDirectory('poppy/mgr-page/resources/libs/easy-web/', 'public/assets/libs/easy-web')
    .copyDirectory('poppy/mgr-page/resources/libs/layui/', 'public/assets/libs/layui')
    .copyDirectory('poppy/mgr-page/resources/libs/vue/', 'public/assets/libs/vue')
    .copyDirectory('poppy/mgr-page/resources/libs/underscore/', 'public/assets/libs/underscore');