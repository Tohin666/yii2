<?php


namespace console\components;

use common\models\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{

    // клиенты чата будут сгруппированы в массив каналов (тасков), чтобы не получать сообщения с чужих каналов
    protected $clients = [];

    /**
     * Chat constructor.
     */
    public function __construct()
    {
//        $this->clients = new \SplObjectStorage();
        // это выведет в консоли при запуске
        echo "server started\n";
    }


    // действия при подключении нового клиента
    function onOpen(ConnectionInterface $conn)
    {
        // в $conn приходят данные о подключении
        // получаем параметр из url запроса
        $queryString = $conn->httpRequest->getUri()->getQuery() ?? "task=0";
        $task = explode("=", $queryString)[1];
        // помещаем клиента в массив в соответствующий ему канал
        $this->clients[$task][$conn->resourceId] = $conn;
        // выводим информацию о подключении в консоль
        echo "\nNew connection : {$conn->resourceId}\n";
        echo "\nChannel : {$task}\n";
    }

    // действия при отключении клиента
    function onClose(ConnectionInterface $conn)
    {
//        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect!";
    }

    // действия при возникновении ошибки
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "\nconn {$conn->resourceId} closed with error:\n";
        echo "\n$e\n";
        $conn->close();
//        $this->clients->detach($conn);
    }

    // действия при получении сообщения
    function onMessage(ConnectionInterface $from, $msg)
    {
        // в данный параметр приходит строка сообщения. Должен прийти джейсон, так что разбираем его.
        $msg = json_decode($msg, true);

        // проверяем от кого будет сообщение, от авторизованного пользователя или от анонима.
        if (!$msg['user']) {
            $userId = null;
            $userName = 'Аноним';
        } else {
            $userId = $msg['user'];
            $userName = User::findOne($msg['user'])->username;
        }

        // проверяем откуда пришло сообщение, из тасков или из общего чата
        if (isset($msg['task'])) {
            $task = $msg['task'];
            $message = new \common\models\tables\TaskChat();
            $message->task_id = $msg['task'];
        } else {
            $task = 0;
            $message = new \common\models\tables\Chat();
        }

        $message->message = $msg['message'];
        $message->user_id = $userId;
        // сохраняем сообщение в соответствующую таблицу бд
        $message->save();

        // выводим информацию в консоль
        echo "({$from->resourceId}) {$userName}: {$msg['message']}\n";
//        echo "{$from->resourceId}: {$msg['message']}\n";

        // перебираем клиентов соответствующего канала, и отправляем каждому сообщение
        foreach ($this->clients[$task] as $client) {
            $client->send($userName . ": " . $msg['message']);
        }
    }


}