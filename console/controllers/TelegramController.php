<?php

namespace console\controllers;


use common\models\tables\TaskProjects;
use common\models\tables\Tasks;
use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSubscribe;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var Component */
    private $bot;
    private $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    public function actionIndex()
    {
        // получаем только новые сообщения, чтобы не читать каждый раз все сообщения. Метод getUpdates получает
        // сообщения бота, а в качестве параметра получаем и передаем ему при помощи метода getOffset с какого сообщения
        // считывать.
        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        // Перебираем сообщения
        if ($updCount > 0) {
            foreach ($updates as $update) {
                // и сохраняем в таблицу
                $this->updateOffset($update);
                // получаем и обрабатываем само сообщение
                if ($message = $update->getMessage()) {
                    $this->processCommand($message);
                }
            }
            echo "Новых сообщений: " . $updCount . PHP_EOL;
        } else {
            echo "Новых сообщений нет" . PHP_EOL;
        }
    }

    // метод получает из таблицы айдишник последнего сообщения.
    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;

    }

    // метод записывает в таблицу новые сообщения
    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s"),
        ]);
        $model->save();
    }

    // метод обрабатывает команды.
    private function processCommand(Message $message)
    {
        // отделяем команду от параметров
        $params = explode(" ", $message->getText());
        $command = $params[0];

        // по умолчанию команда будет не определена.
        $response = "Unknown command";
        switch ($command){
            case '/help':
                $response = "Доступные команды: \n";
                $response .= "/help - список команд \n";
                $response .= "/project_create ##project_name## - создать проект \n";
                $response .= "/task_create ##task_name## ##responcible## ##project## - создать задачу \n";
                $response .= "/sp_create - подписка на созданные проекты \n";
                break;
            case '/sp_create':
                $model = new TelegramSubscribe([
                    // это также айдишник пользователя в телеграмме
                    'chat_id' => $message->getFrom()->getId(),
                    'channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE,
                ]);
                if ($model->save()) {
                    $response = "Вы подписаны на оповещения об обновлении проектов";
                } else {
                    $response = "Error";
                }
                break;
            case '/project_create':
                $model = new TaskProjects([
                    'name' => $params[1],
                ]);
                if ($model->save()) {
                    $response = "Project '{$params[1]}' created successfully!";
                } else {
                    $response = "Error";
                }
                break;
            case '/task_create':
                $model = new Tasks([
                    'title' => $params[1],
                    'date' => date("Y-m-d H:i:s"),
                    'description' => "No description",
                    'responsible_id' => $params[2],
                    'status' => 1,
                    'project_id' => $params[3],
                ]);
                if ($model->save()) {
                    $response = "Task '{$params[1]}' created successfully!";
                } else {
                    $response = "Error";
                }
                break;
        }

        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }

}