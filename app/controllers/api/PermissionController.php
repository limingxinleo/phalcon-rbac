<?php

namespace MyApp\Controllers\Api;

use limx\func\Match;
use MyApp\Controllers\ControllerBase;
use MyApp\Models\RbacPermission;

class PermissionController extends ControllerBase
{

    /**
     * [pfnPermissionListAction desc]
     * @desc 获取权限列表
     * @author limx
     * @return \limx\phalcon\JsonResponse
     */
    public function pfnListAction()
    {
        $pageIndex = $this->request->get('pageIndex');
        $pageSize = $this->request->get('pageSize');
        $pid = $this->request->get('pid');

        $user = RbacPermission::find([
            'conditions' => 'pid=?0',
            'bind' => [$pid],
            'offset' => $pageIndex * $pageSize,
            'limit' => $pageSize
        ]);
        $data['data'] = $user;
        $data['count'] = RbacPermission::count([
            'conditions' => 'pid=?0',
            'bind' => [$pid],
        ]);
        return self::success($data);
    }

    /**
     * [pfnSave desc]
     * @desc 保存权限
     * @author limx
     */
    public function pfnSaveAction()
    {
        $pid = $this->request->get('pid');
        $name = $this->request->get('name');
        $url = $this->request->get('url');
        if (Match::isInt($pid)) {
            $permission = new RbacPermission();
            $permission->pid = $pid;
            $permission->name = $name;
            $permission->url = $url;
            $permission->root = 0;
            if ($permission->save()) {
                $res['redirectUrl'] = url('index/permission/' . $pid);
                return self::success($res);
            }
        }
        return self::error("权限保存失败！");
    }

    public function pfnDelAction()
    {
        $id = $this->request->get('id');
        return self::success([$id]);
    }


}

