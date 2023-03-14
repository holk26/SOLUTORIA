<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    public function index()
    {
        $model = model(HomeModel::class);

        $data['indicadores'] = $model->getIndicadores();

        return view('templates/header')
            . view('home', $data)
            . view('templates/footer');
    }
}
