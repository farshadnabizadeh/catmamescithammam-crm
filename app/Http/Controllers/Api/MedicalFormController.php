<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;

use App\Models\MedicalForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class MedicalFormController extends BaseController
{

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name_surname' => 'required',
            'phone' => 'required',
            'country' => '',
            'email' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'therapist_gender' => 'required',
            'heart_problems' => 'required',
            'blood_pressure' => 'required',
            'varicose_veins' => 'required',
            'asthma' => 'required',
            'vertebral_problem' => 'required',
            'joint_problems' => 'required',
            'fractures' => 'required',
            'skin_allergies' => 'required',
            'lodine_allergies' => 'required',
            'hyperthyroidism' => 'required',
            'diabetes' => 'required',
            'epilepsy' => 'required',
            'pregnant' => 'required',
            'back_problems' => 'required',
            'covid' => 'required',
            'covid_note' => '',
            'surgery' => 'required',
            'surgery_note' => '',
            'signature' => '',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $treatment = MedicalForm::create($input);

        $response = [
            'success' => true,
            'message' => 'Medical Form Received Successfully!'
        ];

        return json_encode($response);
    }
}
