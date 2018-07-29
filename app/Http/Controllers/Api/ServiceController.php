<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 19/06/18
 * Time: 8:02 PM
 */

namespace AlescoSalon\Http\Controllers\Api;


use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Models\Employee;

class ServiceController extends Controller
{


    public function getAvailableServices() {

        $employees = Employee::all();

        $data = [];
        foreach($employees as $employee) {
            $employee->services;
            $employee->serviceCategories;

            $dataToAdd = [
                'person' => [
                    'name' => $employee->name
                ],
                'categories' => []
            ];

            foreach($employee->serviceCategories as $serviceCategory) {
                $dataToAdd['categories'][] = [
                    'id' => $serviceCategory->id,
                    'name' => $serviceCategory->name
                ];
            }

            foreach($employee->services as $employeeService) {

                foreach($dataToAdd['categories'] as $i => $serviceCategory) {
                    if($employeeService->service_category_id === $serviceCategory['id']) {
                        $dataToAdd['categories'][$i]['services'][] = [
                            'name' => $employeeService->name,
                            'cost' => $employeeService->price
                        ];
                    }
                }
            }

            $data[] = $dataToAdd;


        }






        $response['employees'] = $data;

        return response()->json($response);
    }
}