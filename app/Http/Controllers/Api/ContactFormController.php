<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class ContactFormController extends BaseController
{

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name_surname' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $treatment = ContactForm::create([
            'name_surname' => $request->name_surname,
            'phone' => $request->phone,
            'country' => $request->country,
            'form_status_id' => 1,
        ]);

        $response = [
            'success' => true,
            'message' => 'Contact Form Received Successfully!'
        ];

        return json_encode($response);
    }
}
