<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2016/11/10 Time: 9:45
// +----------------------------------------------------------------------
namespace MyApp\Tasks;

use Phalcon\Cli\Task;

class MainTask extends Task
{
    public static $tasks = [
        ['task' => 'System\\Init', 'action' => 'storage', 'params' => []]
    ];

    public function mainAction()
    {
        foreach (self::$tasks as $task) {
            $this->console->handle($task);
        }
    }

}