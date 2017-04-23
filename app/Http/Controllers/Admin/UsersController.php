<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 同步用户信息
     */
    public function sync()
    {
        $app = app('wechat');
        $app = $app->open_platform->createAuthorizerApplication('wx3a333aa39ef5b545','refreshtoken@@@8z1JqTuOPN7Ho7DliNumcSPZBfN4KeaGE_kb_UB2GoM');

//        $openids = $app->user->lists();
//        dd($openids);

        $openids = [
            'ohCsu03V02He0e5wODF3llwTQvQA',
            'ohCsu0ynjTHtpNjdqREsN1xXTH_g',
            'ohCsu04uXdqjEuYJiCKB_m9qyBRo',
        ];

        foreach ($openids as $openid){

            $app->lucky_money->sendNormal([
                'mch_billno'       => date('YmdHis').rand(10000,99999),
                'wxappid' => 'wx3a333aa39ef5b545',
                'send_name' => '尊悦云平台',
                're_openid'        => $openid,
                'total_amount'     => 10,
                'wishing'          => '祝福语',
                'act_name'         => '测试活动',
                'remark'           => '测试备注',
            ]);
        }
    }
}
