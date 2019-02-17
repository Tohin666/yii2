<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_projects}}`.
 */
class m190216_120659_create_task_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->addColumn('tasks', 'project_id', $this->integer());
        $this->addForeignKey('fk_tasks_projects',
            'tasks', 'project_id', 'task_projects', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tasks_projects','tasks');
        $this->dropColumn('tasks', 'project_id');

        $this->dropTable('{{%task_projects}}');
    }
}
