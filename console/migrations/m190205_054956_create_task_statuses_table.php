<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_statuses}}`.
 */
class m190205_054956_create_task_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_statuses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
        ]);

        $this->batchInsert('{{%task_statuses}}', ['name'], [
            ['Новая'],
            ['В работе'],
            ['Выполнена'],
            ['Тестирование'],
            ['Доработка'],
            ['Закрыта'],
        ]);

        $this->addForeignKey('fk_task_statuses',
            'tasks', 'status', 'task_statuses', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_statuses', 'tasks');

        $this->dropTable('{{%task_statuses}}');
    }
}
