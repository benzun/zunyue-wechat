<?php

namespace App\Http\Business;

class AccountsBusiness
{
    /**
     * @param array $wechat_info
     */
    public function store(array $wechat_info = [])
    {
        if (empty($wechat_info)) {

        }

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

            if ($key != 'business_info') {
                $store_data[$key] = $value;
            }
        }
        // 异或运算
        $fun_infos = [0, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048, 4096, 8192, 16384, 32768];

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

        dd($store_data);
    }
}