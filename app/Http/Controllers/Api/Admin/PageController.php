<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 02/05/18
 * Time: 11:50 PM
 */

namespace AlescoSalon\Http\Controllers\Api\Admin;

use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class PageController
 *
 * @package AlescoSalon\Http\Controllers\Api\Admin
 *
 * @property MenuItemRepository menuItems
 * @property PageRepository pages
 * @property EntityRepository pagePhotos
 * @property Files files
 */
class PageController extends Controller
{
    protected $menuItems;
    protected $pages;
    protected $pagePhotos;
    protected $files;

    /**
     * PageController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Formats string for URL.
     *
     * @param $value
     * @return string
     */
    private function urlFormat($value)
    {
        return strtolower(str_replace(' ', '-', $value));
    }

    /**
     * Returns formatted permalink to be saved for page.
     *
     * @return string
     */
    private function setPermalink()
    {
        $permalink = (!empty(request('perma_link'))) ? request('perma_link') : request('title');

        return $this->urlFormat($permalink);
    }


    /**
     * Returns formatted page_key to be saved for page.
     *
     * @return string
     */
    private function setPageKey()
    {
        $page_key = (!empty(request('page_key'))) ? request('page_key') : request('title');
        return $this->urlFormat($page_key);
    }

    /**
     * Handles saving page images.
     *
     * @param $page
     */
    private function saveImages($page)
    {
        $imageDirectory = 'pages';

        if (!empty(request('uploadedImages'))) {
            $this->files->saveMultipleImages(request('uploadedImages'), $page, $imageDirectory);
        }
    }

    /**
     * Handles deleting page images.
     *
     * @param $page
     */
    private function deleteImages($page)
    {
        $imageDirectory = 'pages';

        if (!empty(request('deletedImages'))) {
            $this->files->deleteMultipleImages(request('deletedImages'), $page, $imageDirectory);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages = Page::all();

        $response['pages'] = $pages;

        $status = 200;

        return response()->json($response, $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {

        $pageData = $this->validate(request(), [
            'title' => 'required',
            'content' => '',
            'type' => 'required',
            'meta_title' => '',
            'meta_keywords' => '',
            'meta_desc' => '',
            'is_enabled' => 'required|boolean'
        ]);

        $page = new Page;

        //print_r($pageData);
        $page->fill($pageData);

        $page->perma_link = $this->setPermalink();
        $page->page_key = $this->setPageKey();



        $success = $page->save();

        //$this->saveImages($page);

        // create menu item
/*        if (request('createMenuItem')) {
            $menuItemData = [
                'page' => $page,
                'title' => $page->title,
                'meta_title' => '',
                'meta_keywords' => '',
                'meta_desc' => '',
                'is_enabled' => true
            ];

            $menuItem = MenuItem::fill($menuItemData);
            $this->em->persist($menuItem);
        }*/


        $response['page'] = $page;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function retrieve($id)
    {
        $page = Page::find($id);

        $response['page'] = $page;

        $status = 200;

        return response()->json($response, $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $pageData = $this->validate(request(), [
            'title' => 'required',
            'content' => '',
            'type' => 'required',
            'meta_title' => '',
            'meta_keywords' => '',
            'meta_desc' => '',
            'is_enabled' => 'required|boolean'
        ]);

        $page = Page::find($id);
        $page->update($pageData);

        $page->perma_link = $this->setPermalink();
        $page->page_key = $this->setPageKey();

/*        $this->saveImages($page);

        $this->deleteImages($page);

        if (!empty(request('photos'))) {
            foreach (request('photos') as $order => $photo) {
                $pagePhoto = $this->pagePhotos->find($photo['id']);

                $pagePhotoData = [
                    'orderBy' => $order,
                    'caption' => $photo['caption']
                ];

                $pagePhoto->safeUpdate($pagePhotoData);

                $this->em->persist($pagePhoto);
            }
        }*/

        $success = $page->save();

        $response['page'] = $page;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        // remove it's associated menu item
/*        $menuItem = $this->menuItems->findOneBy([
            'page' => $page->id
        ]);

        if ($menuItem) {
            $this->em->remove($menuItem);
        }*/

        $success = $page->delete();

        $response['page'] = $page;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }
}