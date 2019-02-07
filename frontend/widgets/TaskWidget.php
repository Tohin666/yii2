<?php

namespace frontend\widgets;

use common\models\tables\Tasks;
use yii\base\Widget;

class TaskWidget extends Widget
{

    // виджету передается модель, он сам не делает запрос, чтобы его можно было конфигурировать
    public $model;

    // метод ран вызывается когда вызывается widget или end
    public function run() {

        // проверяем является ли наша модель экземпляром класса таскс
        if (is_a($this->model, Tasks::class)) {
            return $this->render('task', ['model' => $this->model]);
        }

        // иначе вызываем исключение
        throw new \Exception("Невозможно отобразить модель!");

    }


}