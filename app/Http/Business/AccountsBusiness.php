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
        foreach ($wechat_info['authorizer_info'] as $key => &$value) {

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

        foreach ($wechat_info['authorization_info'] as $key => $value) {
            if ($key == 'func_info'){
                $value = array_column($value,'funcscope_category');
            }
            $store_data[$key] = $value;
        }

        dd($store_data);
    }
}