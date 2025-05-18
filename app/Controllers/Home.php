<?php

namespace App\Controllers;

use App\Models\PermohonanModel;
use App\Models\FakultiModel;
use Faker\Factory;
use Faker\Provider\ms_MY\PhoneNumber;

class Home extends BaseController
{
    public function index(): string
    {
        // $this->fakultiModel = new FakultiModel();
        // $fakerMY = Factory::create('ms_MY');

        // $fullName = $fakerMY->randomElement([$fakerMY->firstNameMaleMalay, $fakerMY->firstNameFemaleMalay]).' '.$fakerMY->lastNameMalay;
        // $status = $fakerMY->randomElement([2, 12, 13, 14, 15, 16, 17, 18, 19, 20]);
        // $kelab = $fakerMY->companyName;
        // print_r($fullName.' '.$status.' '.$kelab);
        // exit();

        $data = [
            'pretitle' => 'Utama',
            'title' => 'Laman Utama',
            'ctx' => 'utama',
         ];
   
         return view('utama', $data);
    }
}