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
        return RbacUser::isFirstUse();
    }
}