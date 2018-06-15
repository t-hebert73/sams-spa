<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 14/06/18
 * Time: 10:29 PM
 */

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;

class ServiceCategoryController extends Controller
{

    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $serviceCategories = ServiceCategory::all();

        $response['serviceCategories'] = $serviceCategories;

        $status = 200;

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
        $serviceCategory = ServiceCategory::find($id);

        $response['serviceCategory'] = $serviceCategory;

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

        $serviceCategoryData = $this->validate(request(), [
            'name' => 'required'
        ]);

        $serviceCategory = new ServiceCategory;

        $serviceCategory->fill($serviceCategoryData);

        $success = $serviceCategory->save();

        $response['serviceCategory'] = $serviceCategory;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

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
        $serviceCategoryData = $this->validate(request(), [
            'name' => 'required'
        ]);

        $serviceCategory = ServiceCategory::find($id);
        $serviceCategory->update($serviceCategoryData);

        $success = $serviceCategory->save();

        $response['serviceCategory'] = $serviceCategory;

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
        $serviceCategory = ServiceCategory::find($id);

        $success = $serviceCategory->delete();

        $response['serviceCategory'] = $serviceCategory;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }
}