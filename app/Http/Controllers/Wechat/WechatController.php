<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\OpenPlatform\Guard;

class WechatController extends Controller
{
    private $app;

    /**
     * WechatController constructor.
     */
    public function __construct()
    {
        $this->app = app('wechat');
    }


    /**
     * 公众号第三方平台推送事件
     */
    public function auth()
    {
        $open_platform = $this->app->open_platform;
        $server = $open_platform->server;

        $server->setMessageHandler(function($event) use ($open_platform) {
            switch ($event->InfoType) {
                case Guard::EVENT_AUTHORIZED: // 授权成功
                    $authorizationInfo = $open_platform->getAuthorizationInfo($event->AuthorizationCode);
                    // 保存数据库操作等...
                    break;
                case Guard::EVENT_UNAUTHORIZED: // 更新授权
                    // 更新数据库操作等...
                    break;
                case Guard::EVENT_UPDATE_AUTHORIZED: // 授权取消
                    // 更新数据库操作等...
                    break;
            }
        });

        return $server->serve();
    }

    public function serve()
    {

    }
}
