<?php

namespace App\Models;

use CodeIgniter\Model;

class Uf_Model extends Model
{
    public function get_data(){
            // Definimos las credenciales
            $credentials = array(
                "userName" => "homero9726787_gnd@indeedemail.com",
                "flagJson" => true
            );

            // Convertimos las credenciales a JSON
            $credentialsJson = json_encode($credentials);

            // Configuramos la solicitud
            $ch = curl_init('https://postulaciones.solutoria.cl/api/acceso');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $credentialsJson);

            // Ejecutamos la solicitud
            $response = curl_exec($ch);
            curl_close($ch);

            var_dump($response);
            // Decodificamos la respuesta JSON
            $token = json_decode($response)->accessToken;

           
            // Configuramos la solicitud
            $this->load->library('curlrequest');
            $response = $this->curlrequest->get('https://postulaciones.solutoria.cl/api/indicadores/uf', array(
                'accessToken' => $token
            ));

            // Decodificamos la respuesta JSON
            $data = json_decode($response->body);

            // Guardamos los datos en la base de datos
            $this->db->insert_batch('uf', $data);
    }

    function acceso_api() {
        // Inicializar cURL
        $curl = curl_init();
        
        // Configurar opciones de cURL
        curl_setopt($curl, CURLOPT_URL, 'https://postulaciones.solutoria.cl/api/acceso');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'userName' => 'homero9726787_gnd@indeedemail.com',
            'flagJson' => true
        )));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'accept: */*',
            'Content-Type: application/*+json'
        ));
        
        // Ejecutar solicitud
        $response = curl_exec($curl);
        
        // Manejar respuesta
        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            echo 'Error: ' . $error;
            return;
        }
        
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        if ($http_code === 200) {
            $data = json_decode($response, true);
            return $data;          

        } else {
            echo 'Error: HTTP ' . $http_code;
            return $http_code;     
        }
    }



}