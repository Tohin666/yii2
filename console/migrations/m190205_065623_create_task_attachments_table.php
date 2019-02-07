<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_attachments}}`.
 */
class m190205_065623_create_task_attachments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_attachments}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string(),
        ]);

        $this->addForeignKey('fk_attachments_tasks', 'task_attachments','task_id',
            'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_attachments_tasks', 'task_attachments');

        $this->dropTable('{{%task_attachments}}');
    }
}
