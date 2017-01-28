<?php

namespace MyApp\Models;

class RbacRole extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $desc;

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
     * @return RbacRole[]|RbacRole
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacRole
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * [getRolesByUserId desc]
     * @desc 获得某人所有角色
     * @author limx
     * @param $id
     */
    public static function getRolesByUserId($id)
    {
        $sql = "SELECT * FROM rbac_role AS r
            LEFT JOIN rbac_user_role AS ur ON r.id = ur.role_id
            WHERE ur.user_id = ?;";
        return \limx\phalcon\DB::query($sql, [$id]);
    }

    /**
     * [getRolesAndStatus desc]
     * @desc 获取所有角色 并 返回是否拥有
     * @author limx
     * @param $id
     */
    public static function getRolesAndStatus($id)
    {
        $sql = "SELECT r.*,
            (SELECT count(0) FROM rbac_user_role WHERE user_id = ? AND role_id = r.id ) AS `status` 
            FROM rbac_role AS r;";
        return \limx\phalcon\DB::query($sql, [$id]);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rbac_role';
    }

}
