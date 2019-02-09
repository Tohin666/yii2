<?php


namespace console\components;

use common\models\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{

    protected $clients;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        // это выведет в консоли при запуске
        echo "server started\n";
    }


    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "\nNew connection : {$conn->resourceId}\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconnect!";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "\nconn {$conn->resourceId} closed with error:\n";
        echo "\n$e\n";
        $conn->close();
        $this->clients->detach($conn);
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg, true);

        if ($msg['user'] == "null") {
            $userId = null;
            $userName = 'Аноним';
        } else {
            $userId = $msg['user'];
            $userName = User::findOne($msg['user'])->username;
        }

        if (isset($msg['task'])) {
            $message = new \common\models\tables\TaskChat();
            $message->task_id = $msg['task'];
        } else {
            $message = new \common\models\tables\Chat();
        }

        $message->message = $msg['message'];
        $message->user_id = $userId;
        $message->save();

        echo "({$from->resourceId}) {$userName}: {$msg['message']}\n";
//        echo "{$from->resourceId}: {$msg['message']}\n";
        foreach ($this->clients as $client){
            $client->send($userName . ": " . $msg['message']);
        }
    }


}