<?php

namespace App\Http\Controllers\Admin;

use App\Http\Business\AccountsBusiness;
use App\Http\Controllers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = route('wechat.callback');
        // 直接跳转
        $response = $this->open_platform->pre_auth->redirect($url);
        // 获取跳转的 URL
        return redirect($response->getTargetUrl());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request, AccountsBusiness $accounts_business)
    {
        $auth_code = $request->get('auth_code');

        if (empty($auth_code)) {
            redirect(route('wechat.index'));
        }

        try {
            // 获取授权信息
            $authorization_info = $this->open_platform->getAuthorizationInfo($auth_code)->toArray();

            // 刷新授权Token
            $authorizer_refresh_token = $authorization_info['authorization_info']['authorizer_refresh_token'];

            // 获取授权方的公众号帐号基本信息
            $wechat_info = $this->open_platform->getAuthorizerInfo($authorization_info['authorization_info']['authorizer_appid'])->toArray();

            // 添加公众号授权
            $accounts_business->store($wechat_info, $authorizer_refresh_token);
        } catch (\Exception $e) {
            return redirect(route('wechat.index'));
        }

        return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
