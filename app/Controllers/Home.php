<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($page='Home')
    {
        $model = model(Uf_model::class);

        $token["token"] = $model->acceso_api();

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('home', $token)
            . view('templates/footer');
    }

    public function procesar_ajax() {
        // Procesamiento de la solicitud AJAX aquí
        // Devuelve los datos que deseas enviar de vuelta a la vista
        echo 'Hola mundo';
        return view('index');
        
     }
}
