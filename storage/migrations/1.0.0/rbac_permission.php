<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class RbacPermissionMigration_100
 */
class RbacPermissionMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('rbac_permission', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'pid',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => false,
                            'default' => 0,
                            'size' => 11,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'root',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => false,
                            'default' => 0,
                            'size' => 11,
                            'after' => 'pid'
                        ]
                    ),
                    new Column(
                        'name',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => false,
                            'size' => 45,
                            'after' => 'root',
                            'comment' => '权限名称'
                        ]
                    ),
                    new Column(
                        'url',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => false,
                            'size' => 45,
                            'after' => 'name',
                            'comment' => 'module-controller-action',
                        ]
                    ),
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY'),
                    new Index('URL_INDEX', ['url']),
                    new Index('PID_INDEX', ['pid']),
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        self::$_connection->insert(
            "rbac_permission",
            [1, 0, 1, "超级管理员权限"],
            [
                "id",
                "pid",
                "root",
                "name",
            ]
        );
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
