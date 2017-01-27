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
    public $root;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $module;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $controller;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $action;

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
        return 'rbac_permission';
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

}
