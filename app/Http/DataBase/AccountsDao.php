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
     * @param array $store_data
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
            if (in_array($key, $allow)) {
                $this->model->{$key} = $value;
            }
        }

        if (!$this->model->save()) {
            return false;
        }
        return $this->model;
    }
}