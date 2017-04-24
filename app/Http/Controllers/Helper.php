<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * 获取后台登陆用户信息
     * @param string $field
     */
    public static function getAdminLoginInfo($field = 'id')
    {
        $admin_user = Auth::user();
        if (empty($admin_user)){
            return 1;
        }
        return isset($admin_user[$field]) ? $admin_user[$field] : $admin_user['id'];
    }
}