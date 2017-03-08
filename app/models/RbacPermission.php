<?php

namespace MyApp\Models;

class RbacPermission extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $pid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $root;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $url;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon-rbac");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacPermission[]|RbacPermission
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacPermission
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * [findById desc]
     * @desc 获取一条数据
     * @author limx
     * @param $id
     * @return array
     */
    public static function findById($id)
    {
        $sql = "SELECT * FROM rbac_permission WHERE id = ?";
        return \limx\phalcon\DB::fetch($sql, [$id]);
    }

    /**
     * [isRoot desc]
     * @desc 判断这些角色ID是否有超级管理员权限
     * @author limx
     * @param $ids 角色ID
     */
    public static function isRoot($ids)
    {
        $str = implode(",", $ids);
        $sql = "SELECT p.* FROM `rbac_permission` AS p
            LEFT JOIN `rbac_role_permission` AS rp ON p.id = rp.permission_id
            LEFT JOIN rbac_role AS r ON r.id = rp.role_id
            WHERE r.id IN ({$str}) AND p.root = 1;";
        return \limx\phalcon\DB::fetch($sql);
    }

    /**
     * [getPermissionsAndStatus desc]
     * @desc 获取权限列表 与 此角色是否拥有状态
     * @author limx
     * @param $id
     */
    public static function getPermissionsAndStatus($id)
    {
        $sql = "SELECT p.*,
            (SELECT count(0) FROM rbac_role_permission WHERE role_id = ? AND permission_id = p.id ) AS `status` 
            FROM rbac_permission AS p;";
        return \limx\phalcon\DB::query($sql, [$id]);
    }

    /**
     * @desc 删除此id和pid 的权限
     * @author limx
     * @param $id
     * @return mixed
     */
    public static function del($id)
    {
        $sql = "DELETE FROM rbac_permission WHERE id=? OR pid=?";
        return \limx\phalcon\DB::execute($sql, [$id, $id]);
    }

    public static function allByRoleId($role_id)
    {
        $key = sprintf("CACHE-PERMISSION-BY-ROLEID-%d", $role_id);
        $cache = di('cache');
        $res = $cache->get($key);
        if ($res) {
            return $res;
        }
        $sql = "SELECT p.*,IFNULL((SELECT id 
            FROM rbac_role_permission 
            WHERE role_id=? AND permission_id = p.id),0) AS is_checked 
            FROM rbac_permission AS p; ";
        $res = \limx\phalcon\DB::query($sql, [$role_id]);
        $cache->save($key, $res);
        return $res;
    }

    /**
     * @desc 增加某角色的权限关系表
     * @author limx
     */
    public static function addByRoleId($role_id, $permission)
    {
        if ($role_id == 1) {
            // 无法操作超级管理员权限
            return false;
        }
        $key = sprintf("CACHE-PERMISSION-BY-ROLEID-%d", $role_id);
        $cache = di('cache');
        $cache->delete($key);
        // 删除之前的权限列表
        \limx\phalcon\DB::begin();
        $sql = "DELETE FROM rbac_role_permission WHERE role_id  = ?;";
        $res = \limx\phalcon\DB::execute($sql, [$role_id]);
        if ($res === false) {
            \limx\phalcon\DB::rollback();
            return false;
        }
        $sql = "INSERT INTO rbac_role_permission (role_id,permission_id) VALUES (?,?);";
        foreach ($permission as $item) {
            $res = \limx\phalcon\DB::execute($sql, [$role_id, $item]);
            if ($res === false) {
                \limx\phalcon\DB::rollback();
                return false;
            }
        }
        \limx\phalcon\DB::commit();
        return true;
    }


    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rbac_permission';
    }

}
