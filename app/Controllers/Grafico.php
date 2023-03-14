<?php

namespace App\Controllers;

class Grafico extends BaseController
{
    public function index($page = "Grafico")
    {
        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('home')
            .view('grafico')
            . view('templates/footer');
    }
}
