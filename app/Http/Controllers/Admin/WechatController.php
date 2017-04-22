<?php

namespace App\Http\Controllers\Admin;

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
    public function callback()
    {
        $info = $this->open_platform->getAuthorizationInfo();
        dd($info);
        // 获取授权方的公众号帐号基本信息
        //$this->open_platform->->getAuthorizerInfo();
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
