<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 14/06/18
 * Time: 11:46 PM
 */

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ServiceCategory;
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

        $chosenEmployeeServiceCategories = $request->get('employeeServices');

        $serviceCategoryIdsChosenForEmployee = [];
        foreach($chosenEmployeeServiceCategories as $i => $employeeServiceCategory) {
            // true vs null
            if($employeeServiceCategory) {
                $serviceCategoryIdsChosenForEmployee[] = $allServiceCategories[$i]['id'];
            }
        }

        $employee->serviceCategories()->sync($serviceCategoryIdsChosenForEmployee);


        $response['message'] = 'Success!';

        return response()->json($response);
    }
}