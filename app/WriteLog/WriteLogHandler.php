<?php

namespace  App\WriteLog;

use App\WriteLog\WriteLogInterface;

class WriteLogHandler implements WriteLogInterface
{
    public function telegram()
    {
        return 10;
    }
}
