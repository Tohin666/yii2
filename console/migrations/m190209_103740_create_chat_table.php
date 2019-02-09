<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m190209_103740_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'message' => $this->text(),
        ]);

        $this->addForeignKey('fk_chat_user', 'chat', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_chat_user', 'chat');

        $this->dropTable('{{%chat}}');
    }
}
