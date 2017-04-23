<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $fillable = [
        'admin_users_id', 'nick_name', 'head_img', 'service_type_info', 'verify_type_info', 'user_name',
        'alias', 'qrcode_url', 'open_pay', 'open_shake', 'open_scan', 'open_card', 'open_store',
        'idc', 'principal_name', 'signature', 'authorizer_appid', 'func_info'
    ];
}
