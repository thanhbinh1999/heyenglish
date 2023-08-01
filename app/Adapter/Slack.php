<?php

namespace App\Adapter;

class Slack
{
    private $login;

    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;

        $this->apiKey = $apiKey;
    }

    public function login()
    {
        echo $this->login . " Successfully" . "\n";
    }

    public function sendMessage(string $chatId, $message)
    {
        echo 'Chat id[' . $chatId . '] , message: ' . $message;
    }
}
