<?php

namespace App\Strategy;

interface IExport
{
    public function exportFile($fileName): string;
}
