<?php

namespace App\Controllers;

use App\Models\IndicadoresModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        
        $model = model(IndicadoresModel::class);
        
        $data['indicadores'] = $model->getIndicadores();


        return view('templates/header')
            . view('home', $data)
            . view('templates/footer');
    }

    public function deleteLote()
    {
        $lote = $this->request->getPost('lote');
        $model = model(IndicadoresModel::class);
        
        $model ->where('lote', $lote)->delete();

        $data['indicadores'] = $model->getIndicadores();

        echo "hola ".$lote;

    }

    //View editar indicadores
    public function view($loteI = false)
    {
        $model = model(IndicadoresModel::class);
        
        $data2['dataI'] = $model->getData($loteI);

        if (empty($data2['dataI'])) {
            throw new PageNotFoundException('No encuentro el indicador: ' . $loteI);
        }
        return view('templates/header')
            .view('edite_indicadores',$data2)
            . view('templates/footer');
    }

    public function viewLotes(){
        $model = model(IndicadoresModel::class);
        //echo date('YmdHisu');
        $data['indicadores'] = $model->getIndicadores();

        echo view('parcial_indicadores',$data); 
    }

    public function btnUpdate(){

        $model = model(IndicadoresModel::class);
        
        $data2 = $model->updateApi();

        if ($data2){
            echo "OK";
        }else{
            echo "error";
        }
    }

    public function viewGrafico($loteI = false){
        $model = model(IndicadoresModel::class);
        $data3['dataI'] = $model->getData($loteI);
        echo view('parcial_grafico',$data3);
    }

}
