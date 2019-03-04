<?php

namespace common\models\tables;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Tasks[] $tasks
 */
class TaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['status' => 'id']);
    }


    // getStatusList?
    public static function getTasksList()
    {
        return ArrayHelper::map(
            static::find()
                ->select(['id', 'name'])
                ->asArray()
                ->indexBy('id')
                ->all(), 'id', 'name');
    }


    public static function getStatuses()
    {
        return static::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
