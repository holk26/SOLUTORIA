<?php

namespace App\Models;

use CodeIgniter\Model;

class IndicadoresModel extends Model
{
    protected $table = 'indicadores';
    protected $allowedFields = ['id', 'codigo', 'nombre', 'unidad_medida', 'fecha', 'valor', 'lote'];
    
    public function getIndicadores($lote = false)
    {
        if ($lote === false) {
            return $this->groupBy('lote')->findAll();
        }

        return $this->where(['indicadores' => $lote])->first();
    }
}