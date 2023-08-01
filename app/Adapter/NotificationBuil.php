<?php

namespace App\Adapter;


interface NotificationBuil
{
    public function send(string $title, string $message): void;
}
