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
                case Guard::EVENT_AUTHORIZED: // 授权成功
                    $authorizationInfo = $open_platform->getAuthorizationInfo($event->AuthorizationCode);
                    // 获取授权方的公众号帐号基本信息
                    $wechat_info = $open_platform->getAuthorizerInfo($authorizationInfo['authorization_info']['authorizer_appid'])->toArray();
                    // 刷新Token
                    $wechat_info['authorization_info']['authorizer_refresh_token'] = $authorizationInfo['authorization_info']['authorizer_refresh_token'];
                    // 保存数据库操作等...
                    $accounts_business->store($wechat_info);
                    break;
                case Guard::EVENT_UNAUTHORIZED: // 更新授权
                    // 更新数据库操作等...
                    break;
                case Guard::EVENT_UPDATE_AUTHORIZED: // 授权取消
                    $accounts_business->store([
                        'status' => 'no'
                    ]);
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
