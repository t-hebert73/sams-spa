<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 21/06/18
 * Time: 9:29 PM
 */

namespace AlescoSalon\Http\Controllers\Api;


use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Mail\InquirySubmitted;
use AlescoSalon\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormSubmissionController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitForm(Request $request) {

        $formData = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'source' => 'required'
        ]);

        $inquiry = new Inquiry($formData);

        $inquiry->save();

        // this is bad but im tired
        $requestUrl = 'https://' . $request->getHttpHost() . '/contact';

        Mail::to(env('CONTACT_MAIL_TO'))->send(new InquirySubmitted($inquiry, $requestUrl));

        $response['message'] = 'Thank you for contacting Alesco Salon & Aesthetics!';

        return response()->json($response);
    }
}