<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class RbacRolePermissionMigration_100
 */
class RbacRolePermissionMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('rbac_role_permission', [
                'columns' => [
                    new Column(
                        'role_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'permission_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'role_id'
                        ]
                    ),
                ],
                'indexes' => [
                    new Index('ROLE_PERMISSION_UNIQUE', ['role_id', 'permission_id'], 'UNIQUE'),
                    new Index('PERMISSION_INDEX', ['permission_id']),
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
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
            "rbac_role_permission",
            [1, 1],
            [
                "role_id",
                "permission_id",
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
