<?php

namespace App\Http\DataBase;

class AccountsDao
{
    /**
     * AccountsDao constructor.
     */
    public function __construct()
    {
        $this->model = app('AccountsModel');
    }

    /**
     * 授权添加更细公众号信息
     * @param array $store_data
     * @return bool|\Illuminate\Foundation\Application|mixed
     */
    public function store(array $store_data = [])
    {
        $allow = [
            'admin_users_id',
            'authorizer_appid',
            'nick_name',
            'head_img',
            'service_type_info',
            'verify_type_info',
            'user_name',
            'alias',
            'qrcode_url',
            'open_store',
            'open_scan',
            'open_pay',
            'open_card',
            'open_shake',
            'idc',
            'principal_name',
            'signature',
            'func_info',
            'authorizer_refresh_token',
        ];

        $model = $this->model->where('authorizer_appid', $store_data['authorizer_appid'])->first();

        if (!empty($model)) {
            $this->model = $model;
        }

        foreach ($store_data as $key => $value) {
            if (in_array($key, $allow) && !empty($value)) {
                $this->model->{$key} = $value;
            }
        }

        if (!$this->model->save()) {
            return false;
        }
        return $this->model;
    }

    /**
     * 更新公众号信息
     * @param int $authorizer_appid
     * @param array $update_data
     * @return mixed
     */
    public function update($authorizer_appid = 0, array $update_data = [])
    {
        return $this->model->where('authorizer_appid', $authorizer_appid)->update($update_data);
    }

    /**
     * 获取公众号详情信息
     * @param int $authorizer_appid
     */
    public function show($authorizer_appid = 0)
    {
        return $this->model->where('authorizer_appid', $authorizer_appid)->first();
    }
}