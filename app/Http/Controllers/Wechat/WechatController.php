<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Business\AccountsBusiness;
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
    public function auth(AccountsBusiness $accounts_business)
    {
        $open_platform = $this->app->open_platform;
        $server        = $open_platform->server;

        $server->setMessageHandler(function ($event) use ($open_platform, $accounts_business) {
            switch ($event->InfoType) {
                // 授权取消
                case Guard::EVENT_UNAUTHORIZED:
                    \Log::infO($event->AuthorizerAppid);
                    $accounts_business->update($event->AuthorizerAppid, [
                        'status'           => 'no'
                    ]);
                    break;
            }
        });

        return $server->serve();
    }

    public function serve()
    {

    }
}
