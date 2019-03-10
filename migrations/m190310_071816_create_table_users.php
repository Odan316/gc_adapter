<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m190310_071816_create_table_users
 */
class m190310_071816_create_table_users extends Migration
{

    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->createTable('user', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'password_hash'        => $this->string()->notNull(),
            'auth_key'             => $this->string(32)->notNull()
        ]);

        $admin = new User();
        $admin->username = "admin";
        $admin->setPassword("adminPass");
        $admin->generateAuthKey();
        $admin->save(false);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
