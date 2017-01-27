<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/1/27 Time: 上午8:35
// +----------------------------------------------------------------------
namespace MyApp\Traits;

use limx\func\Match;
use MyApp\Models\RbacUser;

trait Init
{
    /**
     * [isFirstUse desc]
     * @desc 是否第一次使用本项目
     * @author limx
     */
    public static function isFirstUse()
    {
        // TODO:完善自己的判断方法
        return RbacUser::isFirstUse();
    }

    /**
     * [setPassword desc]
     * @desc 密文密码
     * @author limx
     * @param $password
     */
    public static function setPassword($password)
    {
        if (strlen($password) < 6) {
            return dispatch_error(10001, self::getErrorCode(10001));
        }
    }

    /**
     * [getErrorCode desc]
     * @desc 获取错误码
     * @author limx
     * @param $code
     * @return null
     */
    public static function getErrorCode($code)
    {
        $code = sprintf('error_code.%d', $code);
        return app($code);
    }

    /**
     * [saveAdmin desc]
     * @desc 增加管理员
     * @author limx
     */
    public static function addAdmin($name, $password)
    {
        // 完善自己的添加管理员方法
        $user = new RbacUser();
        $user->name = $name;
        $user->password = $password;
        return true;

        return false;
    }

    public static function saveAdmin()
    {

    }
}