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
        return $this->model->create($store_data);
    }
}