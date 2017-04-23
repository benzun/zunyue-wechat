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
        $model = $this->model->where('authorizer_appid', $store_data['authorizer_appid'])->first();
        if (!empty($model)) {
            $this->model = $model;
        }

        foreach ($store_data as $key => $value) {
            $this->model->{$key} = $value;
        }

        if (!$this->model->save()) {
            return false;
        }
        return $this->model;
    }
}