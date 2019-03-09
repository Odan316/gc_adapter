<?php

use yii\db\Migration;

/**
 * Class m190309_090449_create_table_groups
 */
class m190309_090449_create_table_groups extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gc_group', [
            'id' => $this->primaryKey(),
            'gcId' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('gc_group');
    }
}
