<?php

namespace frontend\controllers;

use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        // рекомендуется изменить настройки, чтобы не отваливалось
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        // идет по адресу https://api.telegram.org/bot711757940:AAHFC2A1D9oN1z4Q9eWeuyqIvqO_2kF3aiM/getupdates,
        // получает там джейсон и парсит его в объекты.
        $updates = $bot->getUpdates();

        $messages = [];
        foreach ($updates as $update) {
            $message = $update->getMessage();
            $username = $message->getFrom()->getUsername() ?? $message->getFrom()->getFirstName();
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username,
            ];
        }

        return $this->render('receive', ['messages' => $messages]);

    }

    public function actionSend()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        // рекомендуется изменить настройки, чтобы не отваливалось
        $bot->sendMessage(299738950, "Test!");

    }

}