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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rbac_permission';
    }

}
