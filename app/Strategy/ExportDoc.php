<?php

namespace App\Strategy;

use App\Strategy\IExport;

class ExportDoc  implements IExport
{
    public function exportFile($fileName): string
    {
        return 'Export file DOCS : ' . $fileName;
    }
}
