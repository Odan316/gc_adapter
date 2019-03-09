<?php

use yii\db\Migration;

/**
 * Class m190309_090702_create_table_jc_groups
 */
class m190309_090702_create_table_jc_groups extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('jc_group', [
            'id' => $this->primaryKey(),
            'jcId' => $this->string()->notNull()
        ]);

        $this->createTable('jc_group_gc_group', [
            'jcGroupId' => $this->integer()->notNull(),
            'gcGroupId' => $this->integer()->notNull()
        ]);

        /*$this->addPrimaryKey('PK_jc2gc', 'jc_group_gc_group', ['jcGroupId', 'gcGroupId']);
        $this->addForeignKey('FK_jc2pg_jc',
            'jc_group_gc_group', 'jcGroupId',
            'jc_group', 'id',
            'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_jc2pg_gc',
            'jc_group_gc_group', 'gcGroupId',
            'gc_group', 'id',
            'CASCADE', 'CASCADE');*/
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropForeignKey('FK_jc2pg_jc', 'jc_group_gc_group');
        //$this->dropForeignKey('FK_jc2pg_gc', 'jc_group_gc_group');

        $this->dropTable('jc_group');
        $this->dropTable('jc_group_gc_group');
    }
}
