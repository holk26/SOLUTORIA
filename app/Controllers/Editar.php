<?php

namespace App\Controllers;

use App\Models\IndicadoresModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Editar extends BaseController
{
    public function editaFila()
    {

        $model = model(IndicadoresModel::class);

        $data['indicadores'] = $model->getIndicadores();


        echo "ok";
    }
}
