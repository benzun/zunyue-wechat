<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_users_id');
            $table->string('authorizer_appid', 45)->default('')->comment('AppId');
            $table->string('nick_name', 45)->default('')->comment('昵称');
            $table->string('head_img', 255)->default('')->comment('头像');
            $table->tinyInteger('service_type_info', 1)->default(0)->comment('公众号类型,0订阅号，1升级后的订阅号，2服务号');
            $table->tinyInteger('verify_type_info', 1)->default(-1)->comment('公众号认证类型,-1未认证，0微信认证，1新浪微博认证，2腾讯微博认证，3已资质认证通过但还未通过名称认证，4已资质认证通过、还未通过名称认证，但通过了新浪微博认证，5已资质认证通过、还未通过名称认证，但通过了腾讯微博认证');
            $table->string('user_name', 45)->default('')->comment('公众号原始ID');
            $table->string('principal_name', 45)->default('')->comment('公众号主体名称');
            $table->string('alias', 45)->default('')->comment('微信号');
            $table->string('qrcode_url', 255)->default('')->comment('二维码URL');
            $table->tinyInteger('open_store', 1)->default(0)->comment('是否开通微信门店功能,0代表未开通，1代表已开通');
            $table->tinyInteger('open_scan', 1)->default(0)->comment('是否开通微信扫商品功能,0代表未开通，1代表已开通');
            $table->tinyInteger('open_pay', 1)->default(0)->comment('是否开通微信支付功能,0代表未开通，1代表已开通');
            $table->tinyInteger('open_card', 1)->default(0)->comment('是否开通微信卡券功能,0代表未开通，1代表已开通');
            $table->tinyInteger('open_shake', 1)->default(0)->comment('是否开通微信摇一摇功能,0代表未开通，1代表已开通');
            $table->tinyInteger('idc', 1)->default(0)->comment('');
            $table->string('principal_name', 45)->default('')->comment('主体名称');
            $table->string('signature', 255)->default('')->comment('公众号描述');
            $table->smallInteger('func_info')->unsigned()->default(0)->comment('公众号权限');
            $table->string('authorizer_refresh_token', 255)->default('')->comment('authorizer_refresh_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
