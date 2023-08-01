<?php

namespace App\Adapter;

use App\Adapter\NotificationBuil;

class SlackNotification  implements NotificationBuil
{
    private $slack;

    private $chatId;

    public function __construct(Slack $slack, string $chatId)
    {
        $this->slack = $slack;

        $this->chatId = $chatId;
    }

    public function send(string $title, string $message): void
    {
        $this->slack->login();

        $this->slack->sendMessage($this->chatId, $message);
    }
}
