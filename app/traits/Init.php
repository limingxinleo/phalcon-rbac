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
use MyApp\Models\RbacUserRole;

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
        // TODO:完善自己的密码算法
        $key = env("UNIQUE_ID");
        return md5(md5($password) . $key);
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
    public static function addUser($name, $password)
    {
        // 完善自己的添加管理员方法
        $user = new RbacUser();
        $user->name = $name;
        $user->password = self::setPassword($password);
        if ($user->save()) {
            return $user->id;
        }
        return false;
    }

    /**
     * [addUserRole desc]
     * @desc 新增用户角色关系对应数据
     * @author limx
     * @param $uid
     * @param $role_id
     * @return bool
     */
    public static function addUserRole($uid, $role_id)
    {
        if (!Match::isInt($uid) || !Match::isInt($role_id)) {
            return false;
        }
        $ur = new RbacUserRole();
        $ur->user_id = $uid;
        $ur->role_id = $role_id;
        if ($ur->save()) {
            return true;
        }
        return false;
    }

    public static function saveUser()
    {

    }
}