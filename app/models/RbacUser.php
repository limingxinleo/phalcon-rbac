<?php

namespace MyApp\Models;

class RbacUser extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=45, nullable=false)
     */
    public $password;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon-rbac");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rbac_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacUser[]|RbacUser
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RbacUser
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function isFirstUse()
    {
        $sql = "SELECT * FROM rbac_user AS u
            LEFT JOIN rbac_user_role AS ur ON u.id = ur.user_id
            WHERE ur.role_id = 1; ";
        $user = \limx\phalcon\DB::fetch($sql);
        if (empty($user)) return true;
        return false;
    }

}
