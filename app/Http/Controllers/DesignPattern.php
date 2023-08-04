<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singleton\Database;
use App\Factory\StrdoutLoggerFactory;




/**
 * buider cleasses
 */

use App\Builder\HeroBuilderDirector;
use App\Builder\SuperHero;
use App\Builder\InvokeBuilder;

use App\Adapter\Momo;

use App\Adapter\MomoAdapter;

/**
 * adapter
 */

use App\Adapter\Slack;
use App\Adapter\SlackNotification;


/**
 * facade
 */

use App\Facade\Buy;

/**
 * strategy
 */

use App\Strategy\ExportContext;
use App\Strategy\ExportDoc;
use App\Strategy\ExportPDF;

use function PHPUnit\Framework\once;

/**
 * proxy
 */

use App\Proxy\ProxyImage;
use App\Proxy\Image;

class DesignPattern extends Controller
{
    public function singleton()
    {
        return Database::getInstance()->getConn();
    }

    public function factory()
    {
        $app = new StrdoutLoggerFactory();
    }

    public function builder()
    {
        $invokeHero = new InvokeBuilder();

        $invokeHero->createBody('black', 'long hair]');

        return HeroBuilderDirector::setBuilder($invokeHero);

        $superHero =  new SuperHero();

        $superHero->createBody('read', 'cut');

        //  $heroBuilderDirector->setBuilder($superHero);

        //return $heroBuilderDirector->buildHero();
    }

    public function adapter()
    {
        return (new MomoAdapter(
            (new Momo())
                ->setSecretKey('qwrtioiuytfd_fhgf')
                ->setAppId(100)
        ))->payment();
    }

    public function facade()
    {
        Buy::getInstance()->order();
    }

    public function strategy()
    {

        $exportPDF = ExportContext::getModelExport('export_pdf')->exportFile(__CLASS__ . '.dpf');

        $exportDoc = ExportContext::getModelExport('export_docs')->exportFile(__CLASS__ . '.docs');
    }
    public function proxy()
    {
        header('Content-Type:image/jpg');

        $imageService = ProxyImage::bindSevice(new Image());

        //$imageService->isAdmin();

        $imageService->setLink('https://cdn.tuoitre.vn/zoom/456_285/471584752817336320/2023/5/9/oanh2-1683633291911528345419-0-162-1058-1855-crop-1683633305509800893186.jpg');

        echo $imageService->getImage();
    }

    public function chat()
    {
        $client = new \WebSocket\Client("ws://localhost:8000");
        $client->text(99);
        $client->close();
        ///
    }

    public function loginWithQrCode(Request $request)
    {
        return $request->all();
    }
}
