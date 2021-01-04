<?php

namespace AbarrotesSys\Imports;

use AbarrotesSys\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;




class ProductoImport implements ToModel, WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['codebar'])) 
        {
            return null;
        }
        return new Producto([
            'codebar' => $row['codebar'],
            'desc'    => $row['descripcion'],
            'pcompra' => $row['precio_compra'],
            'pventa'  => $row['precio_venta'],
            'unidad'  => $row['unidad'],
            'total'   => $row['existencia'],
            'filtro'  => $row['filtro'],
            'baja'    => 0,
        ]);
    }
}
