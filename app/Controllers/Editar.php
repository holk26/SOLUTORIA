<?php

namespace App\Controllers;

use App\Models\IndicadoresModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Editar extends BaseController
{
    public function editaFila()
    {
        $model = model(IndicadoresModel::class);

        $id = $this->request->getPost('id');
        $codigo = $this->request->getPost('codigo');
        $nombre = $this->request->getPost('nombre');
        $unidad_medida = $this->request->getPost('unidad_medida');
        $fecha = $this->request->getPost('fecha');
        $valor = $this->request->getPost('valor');

        $data = [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'unidad_medida' => $unidad_medida,
            'fecha' => $fecha,
            'valor' => $valor,
        ];

        $model->update($id, $data);

        echo "Actualización completa. " . $id;
    }

    public function deleteFila()
    {
        $id = $this->request->getPost('id');
        $model = model(IndicadoresModel::class);

        // Eliminar la fila con el id especificado
        $model->delete($id);

        return 'Eliminacion completa '.$id;
    }

    
}
