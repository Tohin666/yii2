<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_chat}}`.
 */
class m190209_155811_create_task_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_chat}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'message' => $this->text(),
        ]);

        $this->addForeignKey('fk_task_chat_tasks', 'task_chat', 'task_id', 'tasks', 'id');
        $this->addForeignKey('fk_task_chat_user', 'task_chat', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_chat_tasks', 'task_chat');
        $this->dropForeignKey('fk_task_chat_user', 'task_chat');

        $this->dropTable('{{%task_chat}}');
    }
}
