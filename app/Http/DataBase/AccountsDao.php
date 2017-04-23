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

    /**
     * @param int $authorizer_appid
     * @param array $update_data
     */
    public function update($authorizer_appid = 0, array $update_data = [])
    {
        $update_data = array_only($update_data, [
            'stauts'
        ]);
        \Log::info($update_data);
        return $this->model->where('authorizer_appid', $authorizer_appid)->update($update_data);

    }
}