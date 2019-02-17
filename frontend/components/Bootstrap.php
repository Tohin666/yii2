<?php

namespace frontend\components;

use common\models\tables\TaskProjects;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс-компонент для подписки на события. Для того чтоб стал компонентом, добавили его в конфиг - components.
 * А чтобы он загружался сразу, добавили его там в bootstrap. И переопределили метод bootstrap чтобы подписка на события
 * выполнялась сразу при загрузке компонента.
 */
class Bootstrap extends Component implements BootstrapInterface
{
    // сам этот бутстрап вызывается через инит. сюда приходит аппликейшн - экземпляр нашего класса
    public function bootstrap($app)
    {
        $this->attachEventsHandlers();
//        $this->changeLanguage();
    }


    protected function attachEventsHandlers()
    {
        Event::on(TaskProjects::class, ActiveRecord::EVENT_AFTER_INSERT, function ($event) {

            $project = $event->sender; // сюда приходит модель TaskProjects
            $projectName = $project->name;
            $subscribers = TaskProjects::find()
                ->where(['name' => $projectName])
                ->all();
            foreach ($subscribers as $subscriber) {
                Yii::$app->bot->sendMessage($subscriber, 'new!');
            }


        });
    }

    protected function changeLanguage()
    {
        $session = Yii::$app->session;
        if ($session['language']) {
            \Yii::$app->language = $session['language'];
        }

    }


}