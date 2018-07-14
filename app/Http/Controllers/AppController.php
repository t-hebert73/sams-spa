<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 27/01/18
 * Time: 10:28 AM
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Api\RoutingController;
use Illuminate\Http\Request;

class AppController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $pageResponseData = $this->getPageResponseData();

        $data['page'] = $pageResponseData['pageData']->page;

        return view('app', $data);
    }


    /**
     * @return mixed
     */
    private function getPageResponseData()
    {
        $pageRequest = new Request();
        $pageRequest->setMethod('GET');
        $url = \Request::path();
        // the routing controller requires prevailing slash
        if ($url !== '/') {
            $url = '/' . $url;
        }
        $pageRequest->request->add(['pageUrl' => $url]);
        $pageRouter = app(RoutingController::class);
        $response = $pageRouter->getPage($pageRequest);
        return $response;
    }
}