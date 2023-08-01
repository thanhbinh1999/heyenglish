<?php

namespace App\Strategy;

use App\Strategy\IExport;

class  ExportPDF  implements IExport
{
    public function exportFile($fileName): string
    {
        return 'Export pdf file : ' . $fileName;
    }
}
