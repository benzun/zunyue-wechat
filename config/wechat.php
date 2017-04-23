<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug' => true,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

    /*
     * 账号基本信息，请从微信公众平台
     */
    'app_id'  => 'wx3a333aa39ef5b545',
    'secret'  => 'b1a0397f44d4d7e22d46aaa99e5afd5f',
    'token'   => 'b67635d5ff2854263004f5da5f70289e',
    'aes_key' => 'T1kQHVs9EgDdnJplSw6BtO7vYbRGqao5rzjCFUM3ex8',

    /**
     * 开放平台第三方平台配置信息
     */
    'open_platform' => [
        'app_id'  => 'wx2593e013b31de004',
        'secret'  => '59bed0d3cc04dac260b6e7adf1347aec',
        'token'   => 'b67635d5ff2854263004f5da5f70289e',
        'aes_key' => 'T1kQHVs9EgDdnJplSw6BtO7vYbRGqao5rzjCFUM3ex8'
    ],

    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file'  => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
    ],

    /*
     * OAuth 配置
     *
     * only_wechat_browser: 只在微信浏览器跳转
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
     */
     'oauth' => [
         'only_wechat_browser' => false,
         'scopes'   => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo'))),
         //'callback' => env('WECHAT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
     ],

    /*
     * 微信支付
     */
     'payment' => [
         'merchant_id'        => '1462249102',
         'key'                => '231e4bed7997475530bd49a959bb78af',
         'cert_path'          => storage_path('cert/apiclient_cert.pem'),
         'key_path'           => storage_path('cert/apiclient_key.pem'),
     ],

    /*
     * 开发模式下的免授权模拟授权用户资料
     *
     * 当 enable_mock 为 true 则会启用模拟微信授权，用于开发时使用，开发完成请删除或者改为 false 即可
     */
    // 'enable_mock' => env('WECHAT_ENABLE_MOCK', true),
    // 'mock_user' => [
    //     "openid" =>"odh7zsgI75iT8FRh0fGlSojc9PWM",
    //     // 以下字段为 scope 为 snsapi_userinfo 时需要
    //     "nickname" => "overtrue",
    //     "sex" =>"1",
    //     "province" =>"北京",
    //     "city" =>"北京",
    //     "country" =>"中国",
    //     "headimgurl" => "http://wx.qlogo.cn/mmopen/C2rEUskXQiblFYMUl9O0G05Q6pKibg7V1WpHX6CIQaic824apriabJw4r6EWxziaSt5BATrlbx1GVzwW2qjUCqtYpDvIJLjKgP1ug/0",
    // ],
];
