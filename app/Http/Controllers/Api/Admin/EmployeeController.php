<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 13/06/18
 * Time: 12:29 AM
 */

namespace AlescoSalon\Http\Controllers\Api\Admin;


use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Models\Employee;

class EmployeeController extends Controller
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

        $employees = Employee::all();

        $response['employees'] = $employees;

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
        $employee = Employee::find($id);

        $employee->serviceCategories;

        $response['employee'] = $employee;

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

        $employeeData = $this->validate(request(), [
            'name' => 'required'
        ]);

        $employee = new Employee;

        //print_r($employeeData);
        $employee->fill($employeeData);


        $success = $employee->save();

        //$this->saveImages($employee);

        // create menu item
        /*        if (request('createMenuItem')) {
                    $menuItemData = [
                        'employee' => $employee,
                        'title' => $employee->title,
                        'meta_title' => '',
                        'meta_keywords' => '',
                        'meta_desc' => '',
                        'is_enabled' => true
                    ];
        
                    $menuItem = MenuItem::fill($menuItemData);
                    $this->em->persist($menuItem);
                }*/


        $response['employee'] = $employee;

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
        $employeeData = $this->validate(request(), [
            'name' => 'required'
        ]);

        $employee = Employee::find($id);
        $employee->update($employeeData);

        /*        $this->saveImages($employee);
        
                $this->deleteImages($employee);
        
                if (!empty(request('photos'))) {
                    foreach (request('photos') as $order => $photo) {
                        $employeePhoto = $this->employeePhotos->find($photo['id']);
        
                        $employeePhotoData = [
                            'orderBy' => $order,
                            'caption' => $photo['caption']
                        ];
        
                        $employeePhoto->safeUpdate($employeePhotoData);
        
                        $this->em->persist($employeePhoto);
                    }
                }*/

        $success = $employee->save();

        $response['employee'] = $employee;

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
        $employee = Employee::find($id);

        // remove it's associated menu item
        /*        $menuItem = $this->menuItems->findOneBy([
                    'employee' => $employee->id
                ]);
        
                if ($menuItem) {
                    $this->em->remove($menuItem);
                }*/

        $success = $employee->delete();

        $response['employee'] = $employee;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }
}