<?php

namespace App\Strategy;

use App\Strategy\IExport;

use App\Strategy\ExportDoc;

use App\Strategy\ExportPDF;

class ExportContext implements IExport
{

    private static $export;

    const EXPORT_DOCS = 'export_docs';

    const EXPORT_PDF =  'export_pdf';


    /**
     * @param App\Strategy\IExport
     */
    public function setStratege(IExport $export)
    {
        $this->export = $export;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function exportFile($fileName): string
    {
        return static::$export->exportFile($fileName);
    }
    /**
     * @param string $model
     * @return  mixed
     */
    public function getModelExport($model)
    {
        static::$export = static::loadExportCommon()[$model];

        return (new static);
    }

    /**
     * @return array
     */
    private function loadExportCommon()
    {
        return [
            static::EXPORT_DOCS  => new ExportDoc(),
            static::EXPORT_PDF  => new ExportPDF()
        ];
    }

    public static function __callStatic($method, $arguments)
    {
        return $method(...$arguments);
    }
}
