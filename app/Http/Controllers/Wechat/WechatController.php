<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Business\AccountsBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\OpenPlatform\Guard;

class WechatController extends Controller
{
    /**
     * @var mixed
     */
    private $open_platform;

    /**
     * WechatController constructor.
     */
    public function __construct()
    {
        $app = app('wechat');
        $this->open_platform = $app->open_platform;
    }


    /**
     * 公众号第三方平台推送事件
     * Author weixinhua
     * @param AccountsBusiness $accounts_business
     * @return mixed
     */
    public function auth(AccountsBusiness $accounts_business)
    {
        $open_platform = $this->open_platform;
        $server = $open_platform->server;

        $server->setMessageHandler(function ($event) use ($open_platform, $accounts_business) {
            switch ($event->InfoType) {
                // 授权取消
                case Guard::EVENT_UNAUTHORIZED:
                    $accounts_business->update($event->AuthorizerAppid, [
                        'status' => 'no'
                    ]);
                    break;
            }
        });

        return $server->serve();
    }

    /**
     * 公众号消息与事件接收
     * @param null $authorizer_appid
     * @param AccountsBusiness $accounts_business
     * @return mixed
     */
    public function show($authorizer_appid = null, AccountsBusiness $accounts_business)
    {
        \Log::info('service');
        $open_platform = $this->open_platform;
        // 获取授权公众号详情
        $wechat_info = $accounts_business->show($authorizer_appid);
        // 调用授权公众号API
        $app = $open_platform->createAuthorizerApplication($authorizer_appid, $wechat_info->authorizer_refresh_token);
        // 授权公众号服务端
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                default:
                    return '收到其它消息';
                    break;
            }
        });
        return $server->serve();
    }
}
