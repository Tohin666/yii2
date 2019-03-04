<?php

use yii\db\Migration;

/**
 * Handles adding administrator_id to table `{{%tasks}}`.
 */
class m190301_051120_add_administrator_id_column_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tasks}}', 'administrator_id', $this->integer());

        $this->addForeignKey('fk_tasks_user_administrator', 'tasks', 'administrator_id',
            'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tasks_user_administrator', 'tasks');

        $this->dropColumn('{{%tasks}}', 'administrator_id');
    }
}
