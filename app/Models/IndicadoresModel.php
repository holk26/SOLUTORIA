<?php

namespace App\Models;

use CodeIgniter\Model;

class IndicadoresModel extends Model
{
    protected $table = 'indicadores';
    protected $allowedFields = ['id', 'codigo', 'nombre', 'unidad_medida', 'fecha', 'valor', 'lote'];

    public function getIndicadores()
    {
        return $this->groupBy('lote')->findAll();
    }

    public function getData($lote)
    {
        return $this->where(['lote' => $lote])->limit(6)->orderBy('id', 'ASC')->findAll();
    }

    public function updateApi()
    {
        $accessToken = '';
        $accessUrl = 'https://postulaciones.solutoria.cl/api/acceso';
        $accessData = array(
            'userName' => 'homero9726787_gnd@indeedemail.com',
            'flagJson' => true
        );

        $accessOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($accessData)
            )
        );

        $accessContext  = stream_context_create($accessOptions);
        $accessResult = file_get_contents($accessUrl, false, $accessContext);

        if ($accessResult !== false) {
            $accessResult = json_decode($accessResult, true);
            $accessToken = $accessResult['token'];
        }

        $url = 'https://postulaciones.solutoria.cl/api/indicadores';
        $headers = array(
            'Authorization: Bearer ' . $accessToken
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $data = json_decode($response, true);
            //var_dump($data);
            $lote33 = microtime(true);
            //echo "LOTE ".$lote33;
            foreach ($data as $key => $value) {
                $insertData = [
                    'codigo' => $value['codigoIndicador'],
                    'nombre' => $value['nombreIndicador'],
                    'unidad_medida' => $value['unidadMedidaIndicador'],
                    'fecha' => $value['fechaIndicador'],
                    'valor' => $value['valorIndicador'],
                    'lote' => $lote33
                ];
                $this->insert($insertData);
            }
            return true;
        } else {
            echo "error";
            return false;
        }
    }
}
