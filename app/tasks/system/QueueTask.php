<?php
// +----------------------------------------------------------------------
// | 消息队列 REDIS抽象类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
declare(ticks = 1);
namespace MyApp\Tasks\System;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;
use swoole_process;

abstract class QueueTask extends Task
{
    // 最大进程数
    protected $maxProcesses = 500;
    // 当前进程数
    protected $process = 0;
    // 消息队列Redis键值
    protected $queueKey = '';
    // 子进程数到达最大值时的等待时间
    protected $waittime = 1;

    public function mainAction()
    {
        if (!extension_loaded('swoole')) {
            echo Color::error('The swoole extension is not installed');
            return;
        }
        if (empty($this->queueKey)) {
            echo Color::error('Please rewrite the queueKey');
            return;
        }
        // install signal handler for dead kids
        pcntl_signal(SIGCHLD, [$this, "signalHandler"]);
        set_time_limit(0);
        // 实例化Redis实例
        $redis = $this->redisClient();
        while (true) {
            if ($this->process < $this->maxProcesses) {
                // 无任务时,阻塞等待
                $data = $redis->brpop($this->queueKey, 3);
                if (!$data) {
                    continue;
                }
                if ($data[0] != $this->queueKey) {
                    // 消息队列KEY值不匹配
                    continue;
                }
                if (isset($data[1])) {
                    $process = new swoole_process([$this, 'task']);
                    $process->write($this->rewrite($data[1]));
                    $pid = $process->start();
                    if ($pid === false) {
                        $redis->lpush($this->queueKey, $data[1]);
                    } else {
                        $this->process++;
                    }
                }
            } else {
                if (is_int($this->waittime) && $this->waittime > 0) {
                    sleep($this->waittime);
                }
            }
        }
    }

    /**
     * @desc   子进程
     * @author limx
     * @param swoole_process $worker
     */
    public function task(swoole_process $worker)
    {
        swoole_event_add($worker->pipe, function ($pipe) use ($worker) {
            // 从主进程中读取到的数据
            $recv = $worker->read();
            $this->run($recv);
            $worker->exit(0);
            swoole_event_del($pipe);
        });
    }

    /**
     * @desc   主进程中操作数据
     * @tip    主进程中不能实例化DB类，因为Mysql连接会中断
     *         暂时原因不明，可能是会被子进程释放掉
     * @author limx
     * @param $data 消息队列中的数据
     * @return mixed 返回给子进程的数据
     */
    protected function rewrite($data)
    {
        return $data;
    }

    /**
     * @desc   返回redis实例
     * @author limx
     * @return mixed
     */
    abstract protected function redisClient();

    /**
     * @desc   消息队列执行的业务代码
     * @author limx
     * @return mixed
     */
    abstract protected function run($recv);

    /**
     * @desc   信号处理方法 回收已经dead的子进程
     * @author limx
     * @param $signo
     */
    private function signalHandler($signo)
    {
        switch ($signo) {
            case SIGCHLD:
                while (swoole_process::wait(false)) {
                    $this->process--;
                }

            default:
                break;
        }
    }
}