<?php

namespace App\Http\Business;

use App\Http\Controllers\Helper;
use App\Http\DataBase\AccountsDao;

class AccountsBusiness
{
    /**
     * AccountsBusiness constructor.
     * @param AccountsDao $dao
     */
    public function __construct(AccountsDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param array $wechat_info
     */
    public function store(array $wechat_info = [], $authorizer_refresh_token = null)
    {
        $store_data = [];
        foreach ($wechat_info['authorizer_info'] as $key => $value) {

            if (in_array($key, ['service_type_info', 'verify_type_info'])) {
                $value = $value['id'];
            }

            if ($key == 'business_info') {
                foreach ($value as $business_info_key => $business_info_value) {
                    $store_data[$business_info_key] = $business_info_value;
                }
            }
        }

        $fun_infos = config('admin.fun_info');
        foreach ($wechat_info['authorization_info'] as $key => $value) {
            if ($key == 'func_info') {
                // 获取授权权限id
                $func_info_ids = array_column(array_column($value, 'funcscope_category'), 'id');

                $value = 0;
                foreach ($func_info_ids as $func_info_id) {
                    $value += $fun_infos[$func_info_id];
                }
            }
            $store_data[$key] = $value;
        }


        $store_data['admin_users_id'] = Helper::getAdminLoginInfo();
        $store_data['authorizer_refresh_token'] = $authorizer_refresh_token;

        return $this->dao->store($store_data);
    }
}