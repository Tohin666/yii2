<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_project_users}}`.
 */
class m190303_065834_create_task_project_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_project_users}}', [
            'project_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_task_project', 'task_project_users', 'project_id',
            'task_projects', 'id');
        $this->addForeignKey('fk_task_project_user', 'task_project_users', 'user_id',
            'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_project', 'task_project_users');
        $this->dropForeignKey('fk_task_project_user', 'task_project_users');

        $this->dropTable('{{%task_project_users}}');
    }
}
