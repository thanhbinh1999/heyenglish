<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PermissionMiileware;
use Closure;
use DateTime;
use Dompdf\Cellmap;
use Exception;
use Faker\Core\Number;
use Illuminate\Cache\ApcStore;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Mockery\Undefined;
use Rakit\Validation\Rules\Numeric;
use Rakit\Validation\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Throwable;

use function PHPUnit\Framework\callback;

class ZaloController extends Controller
{

    private $values = '';

    private $params  = [
        'page' => 13,
        'limit' => 1,
        'search' => 'xxx',
        'sort' => 'desc'
    ];

    private $data =  [
        'total' => 2,
        'data' => [
            ['id' => 1, 'name' => 'a'],
            ['id' => 3, 'name' => 'b']
        ]
    ];


    public function __construct()
    {
    }
    public function login(Request $request)
    {
        $token =  "base64:6ciatZsf3EJvrEJBZhmgxubSHwL5lfnNo609tmGv6fU=";

        $base64QRCode =  base64_encode(\QrCode::size(100)->generate($token));

        $base64QRDecode = base64_decode($base64QRCode);

        $image  = imagepng($base64QRDecode, 'test.png');

        return $image;

        return view('login', [
            'base64QRCode' => $base64QRCode
        ]);
    }

    public function block()
    {
        $lock = \DB::unprepared('lock table messages read');
        return $lock;
        //  $messages  = \DB::select(\DB::raw('select connection_id() as session_id'));
        /// return $messages;
    }

    public function form()
    {
        $pagination = new Pagination();

        return $pagination
            ->bindRequest($this->params)
            ->handle(function ($request) {
                return $this->getUsers($request);
            });
    }

    private function getUsers($request)
    {
        return $this->data;
    }



    private function getResourceScanned($resources)
    {

        if (empty($resources)) {
            return [];
        }

        $groupResourceByProductName = [];

        $groupDays = [];

        foreach ($resources as $index =>  $resource) {

            $siteProduct = $resource['site_product'];

            $dateScan = $resource['date_scan'];

            if (!in_array($dateScan, $groupDays)) {
                $groupDays[] = $dateScan;
            }

            $groupResourceByProductName[$siteProduct][] = $resource;
        }

        foreach ($groupResourceByProductName as &$products) {
            $chunkDate = array_map(function ($product) {
                return $product['date_scan'];
            }, $products);

            $diffs = array_diff($groupDays, $chunkDate);

            if (!empty($diffs)) {
                foreach ($diffs as $diff) {
                    $products[] = [
                        'site_product' => 0,
                        'date_scan' => $diff
                    ];
                }
            }
        }

        return $groupResourceByProductName;
    }

    private  function forPage($request = [], Closure $callback)
    {

        $page = isset($request['page']) && $request['page'] > 0 ? ceil($request['page']) : 1;

        $limit  = isset($request['limit']) && $request['limit'] > 0 ?  ceil($request['limit']) : 10;

        $offset = ceil($page - 1) * $limit;

        $request = array_merge($request, compact('offset'));

        $results =  $callback($request);

        if (empty($results)) {
            return response()->json([]);
        }

        return  response()->json([
            'meta' => [
                'current_page' => $page,
                'total_pages' => ceil($results['total'] / $limit)
            ],
            'data' => $results['data']
        ]);
    }
}

/// offset,limit

class Pagination
{
    /**
     * @var int $page
     */

    private $page = 1;

    /**
     * @var int $limit
     */
    private $limit = 9;

    /**
     * @var int $offset
     */

    private $offset = 0;

    /**
     * @var array $results
     */

    private $results;

    /**
     * @var string $pageKeyName
     */

    private $pageKeyName = 'page';

    /**
     * @var string $limitKeyName 
     */

    private $limitKeyName = 'limit';

    /**
     * @var string $offsetKeyName 
     */

    private $offsetKeyName = 'offset';


    /**
     * @var array $request
     */

    private $request = [];


    public function bindRequest($request = [])
    {
        $this->request  = $request;

        return $this;
    }

    public function setPage($page)
    {
        $this->mergeRequest([$this->pageKeyName => $page]);

        return $this;
    }

    public function setLimit($limit)
    {
        $this->mergeRequest([$this->limitKeyName => $limit]);

        return $this;
    }

    private function mergeRequest($values)
    {
        $this->request = array_merge($this->request, $values);

        return $this;
    }


    public function handle(Closure $callback)
    {

        if (isset($this->request[$this->pageKeyName]) && $this->request[$this->pageKeyName] > 0) {
            $this->page = $this->request[$this->pageKeyName];
        } else {
            $this->setPage($this->page);
        }

        if (isset($this->request[$this->limitKeyName]) && $this->request[$this->limitKeyName] > 0) {
            $this->limit = $this->request[$this->limitKeyName];
        } else {
            $this->setLimit($this->limit);
        }

        $this->mergeRequest([
            $this->offsetKeyName => $this->offset = ceil($this->page - 1) * $this->limit
        ]);

        $result =  $callback($this->request);

        return response()
            ->json([
                'meta' => [
                    'current_page' => $this->page,
                    'limit' => $this->limit,
                    'total_pages' => ceil($result['total'] / $this->limit),
                    'total_items' => count($result['data'])
                ],
                'data' => $result['data']
            ]);
    }
}
