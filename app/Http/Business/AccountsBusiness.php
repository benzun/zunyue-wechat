<?php

namespace App\Http\Business;

use App\Http\Controllers\Helper;
use App\Http\DataBase\AccountsDao;
use Illuminate\Support\Facades\Cache;

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
     * 授权添加更细公众号信息
     * Author weixinhua
     * @param array $wechat_info
     * @param null $authorizer_refresh_token
     * @return bool|\Illuminate\Foundation\Application|mixed
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
            $store_data[$key] = $value;
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

        $result = $this->dao->store($store_data);

        if (empty($result)) {
            Cache::forget('account_' . $wechat_info['authorization_info']['authorizer_appid']);
        }
        return $result;
    }

    /**
     * 更新公众号信息
     * @param int $authorizer_appid
     * @param array $update_data
     * @return mixed
     */
    public function update($authorizer_appid = 0, array $update_data = [])
    {
        if (empty($authorizer_appid) || empty($update_data)) {

        }
        $result = $this->dao->update($authorizer_appid, $update_data);
        if (!empty($result)) {
            Cache::forget('account_' . $authorizer_appid);
        }
        return $result;
    }

    /**
     * 获取公众号详情信息
     * Author weixinhua
     * @param int $authorizer_appid
     * @return mixed
     */
    public function show($authorizer_appid = 0)
    {
        if (empty($authorizer_appid)) {

        }

        return Cache::rememberForever('account_' . $authorizer_appid, function () use ($authorizer_appid) {
            return $this->dao->show($authorizer_appid);
        });
    }
}