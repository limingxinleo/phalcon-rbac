<?php

namespace MyApp\Models;

class RbacUserRole extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $user_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $role_id;

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
     * @return RbacUserRole[]|RbacUserRole
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacUserRole
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * [del desc]
     * @desc 删除某人所有关系
     * @author limx
     * @param $uid
     */
    public static function del($uid)
    {
        $sql = "DELETE FROM rbac_user_role WHERE user_id=?";
        return \limx\phalcon\DB::execute($sql, [$uid]);
    }

    /**
     * [add desc]
     * @desc 增加用户角色关系
     * @author limx
     * @param $uid
     * @param $role
     */
    public static function add($uid, $role)
    {
        $sql = "INSERT INTO rbac_user_role(user_id,role_id) VALUES(?,?)";
        foreach ($role as $role_id) {
            $res = \limx\phalcon\DB::execute($sql, [$uid, $role_id]);
            if ($res === false) return false;
        }
        return true;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rbac_user_role';
    }

}
