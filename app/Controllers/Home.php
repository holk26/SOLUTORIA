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

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('home')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }
}
