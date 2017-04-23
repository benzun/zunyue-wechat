<?php

namespace App\Http\Business;

class AccountsBusiness
{
    /**
     * @param array $wechat_info
     */
    public function store(array $wechat_info = [])
    {
        if (empty($wechat_info)){

        }

        $store_data = [];
        foreach ($wechat_info['authorizer_info'] as $key => $value){
            if ($key == 'service_type_info'){
                $value['service_type_info'] = $value['id'];
            }

            if ($key == 'verify_type_info'){
                $value['verify_type_info'] = $value['id'];
            }

            if ($key == 'business_info'){
                foreach ($value['business_info'] as $business_info_key => $business_info_value){
                    $store_data[$business_info_key] = $business_info_value;
                }
                unset($key);
            }

            $store_data[$key] = $value;
        }

        dd($store_data);
    }
}