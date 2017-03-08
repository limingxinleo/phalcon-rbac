<?php
// +----------------------------------------------------------------------
// | 数据库操作 LISTENER [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/2/28 Time: 下午4:02
// +----------------------------------------------------------------------
namespace MyApp\Listeners\System;

use Phalcon\Db\Profiler;
use Phalcon\Events\Event;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileLogger;

class DbListener
{
    const TIMEOUT = 0.1;
    protected $_profiler;

    protected $_logger;

    /**
     *创建分析器并开始纪录
     */
    public function __construct()
    {
        $config = di('config');
        $dir = $config->application->logDir . date('Ymd');
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        $this->_profiler = new Profiler();
        $this->_logger = new FileLogger($dir . "/db.log");
    }

    /**
     * 如果事件触发器是'beforeQuery'，此函数将会被执行
     */
    public function beforeQuery(Event $event, $connection)
    {
        $this->_profiler->startProfile(
            $connection->getSQLStatement()
        );
    }

    /**
     * 如果事件触发器是'afterQuery'，此函数将会被执行
     */
    public function afterQuery(Event $event, $connection)
    {
        $this->_profiler->stopProfile();
        // 保存sql语句以及执行时间
        $this->logSql();
    }

    public function getProfiler()
    {
        return $this->_profiler;
    }

    /**
     * @desc 记录sql执行日志
     * @author limx
     */
    public function logSql()
    {
        $profile = $this->getProfiler()->getLastProfile();

        $sql = $profile->getSQLStatement();
        $begintime = $profile->getInitialTime();
        $endtime = $profile->getFinalTime();
        $runtime = $profile->getTotalElapsedSeconds();

        $str = PHP_EOL;
        $str .= "SQL语句: " . $sql . PHP_EOL;
        $str .= "开始时间: " . $begintime . PHP_EOL;
        $str .= "结束时间: " . $endtime . PHP_EOL;
        $str .= "执行时间: " . $runtime . PHP_EOL;
        if ($runtime > self::TIMEOUT) {
            $this->_logger->log($str, Logger::WARNING);
        } else {
            $this->_logger->log($str, Logger::INFO);
        }
    }

}