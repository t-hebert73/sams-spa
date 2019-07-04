<?php
/**
 * Created by PhpStorm.
 * User: trevor
 * Date: 21/06/18
 * Time: 10:00 PM
 */

namespace AlescoSalon\Http\Controllers\Api;


use AlescoSalon\Http\Controllers\Controller;
use AlescoSalon\Models\Inquiry;

class InquiryController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();

        $response['inquiries'] = $inquiries;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function retrieve($id)
    {
        $page = Inquiry::find($id);

        $response['inquiry'] = $page;

        $status = 200;

        return response()->json($response, $status);
    }
}