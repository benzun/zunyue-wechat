<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
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
}
