<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 14/06/18
 * Time: 11:46 PM
 */

namespace AlescoSalon\Http\Controllers\Api\Admin;


use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Models\Employee;
use AlescoSalon\Models\Service;
use AlescoSalon\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveInfo(Request $request) {

        $employee = Employee::find($request->get('employeeId'));

        $allServiceCategories = $request->get('allServiceCategories');

        $chosenEmployeeServiceCategories = $request->get('employeeServiceCategories');

        $serviceCategoryIdsChosenForEmployee = [];
        foreach($chosenEmployeeServiceCategories as $i => $employeeServiceCategory) {
            // true vs null
            if($employeeServiceCategory) {
                $serviceCategoryIdsChosenForEmployee[] = $allServiceCategories[$i]['id'];
            }
        }

        $employee->serviceCategories()->sync($serviceCategoryIdsChosenForEmployee);

        $employeeServices = $request->get('employeeServices');

        if(!empty($employeeServices)) {
            foreach($employeeServices as $employeeService) {

                if(!empty($employeeService['id'])) {

                    $service = Service::find($employeeService['id']);

                    $service->name = $employeeService['name'];
                    $service->price = $employeeService['price'];

                    $service->save();

                } else {
                    if(!empty($employeeService['name']) || !empty($employeeService['price'])) {
                        $serviceCategory = ServiceCategory::where('name', $employeeService['category'])->first();

                        $service = new Service([
                            'name' => $employeeService['name'],
                            'price' => $employeeService['price']
                        ]);

                        $service->serviceCategory()->associate($serviceCategory);
                        $service->employee()->associate($employee);

                        $service->save();
                    }
                }



            }
        }


        $response['message'] = 'Success!';

        return response()->json($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployeeServices($id) {

        $employeeServices = Service::where('employee_id', $id)->get();

        if(!empty($employeeServices)) {
            foreach($employeeServices as $employeeService) {
                $employeeService->serviceCategory;
            }
        }

        $response['employeeServices'] = $employeeServices;
        return response()->json($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyEmployeeService($id) {
        $service = Service::find($id);
        
        $success = $service->delete();

        $response['service'] = $service;

        if ($success) {
            $status = 200;
        } else {
            $response['message'] = 'There was an error. Check the activity log.';
            $status = 422;
        }

        return response()->json($response, $status);
    }
}