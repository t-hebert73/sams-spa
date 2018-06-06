<?php
    /**
     * Created by PhpStorm.
     * User: trevor
     * Date: 06/05/18
     * Time: 10:31 PM
     */


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

/**
 * Class RoutingController
 *
 * @package App\Http\Controllers\Api
 *
 * @property \stdClass pageData
 */
class RoutingController extends Controller
{

    protected $pageData;

    /**
     * RoutingController constructor.
     */
    public function __construct() {

    }

    /**
     * @param $permaLink
     * @return mixed
     */
    private function findEnabledPage($permaLink)
    {
        return Page::where('perma_link', $permaLink)->where('is_enabled', 1)->firstOrFail();
    }

    /**
     * @param $page
     * @return bool
     */
    private function isSitemapPage($page)
    {
        return ($page->type == 'Sitemap');
    }

    /**
     * @param $pageUrl
     * @return array
     */
    private function segmentUrl($pageUrl)
    {
        // remove the initial slash if present
        $pos = strpos($pageUrl, '/');
        if ($pos !== false) {
            $pageUrl = substr_replace($pageUrl, '', $pos, strlen('/'));
        }

        if (!empty($pageUrl)) {
            $urlSegments = explode('/', $pageUrl);
        } else {
            $urlSegments[0] = '/'; // home page
        }

        return $urlSegments;
    }

    /**
     * Sets up the base for the page data response
     */
    private function setupPageResponseData()
    {
        $pageData = new \stdClass();
        $pageData->parentPage = null;
        $pageData->page = null;
        $pageData->objects = null;

        $this->pageData = $pageData;
    }

    /**
     * @param $page
     * @return bool
     */
    private function isPage($page)
    {
        return (!empty($page));
    }

    /**
     * @param null $page
     * @param null $objects
     * @param null $parentPage
     */
    private function setPageData($page = null, $objects = null, $parentPage = null)
    {
        if ($page) {
            $this->pageData->page = $page;
        }

        if ($objects) {
            $this->pageData->objects = $objects;
        }

        if ($parentPage) {
            $this->pageData->parentPage = $parentPage;
        }
    }

    /**
     * Return an enabled page matching a passed perma link
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPage(Request $request)
    {
        $pageUrl = $request->get('pageUrl');
        $urlSegments = $this->segmentUrl($pageUrl);

        $this->setupPageResponseData();

        $page = $this->findEnabledPage($urlSegments[0]);

        if ($this->isPage($page)) {

            $this->setPageData($page);
        }

        $response['pageData'] = $this->pageData;

        return response()->json($response);
    }
}