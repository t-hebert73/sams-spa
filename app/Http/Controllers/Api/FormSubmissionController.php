<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 21/06/18
 * Time: 9:29 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{

    public function submitForm(Request $request) {

        $formData = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'source' => 'required'
        ]);

        $inquiry = new Inquiry($formData);

        $inquiry->save();

        $response['message'] = 'Thank you for contacting Alesco Salon!';

        return response()->json($response);
    }
}