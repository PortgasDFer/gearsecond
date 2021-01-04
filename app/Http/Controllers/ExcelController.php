<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use Redirect;
use AbarrotesSys\Imports\ProductoImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * [importarProductos Metodo para leer el archivo xlsx, cada fila se registrara en la base de datos.]
     * @param  Request $request [un archivo xlsx]
     * @return [type]           [description]
     */
    public function importarProductos(Request $request)
    {
        /** Cargando el excel mediante un archivo recibido vía POST con name=productos */
         Excel::import(new ProductoImport, request()->file('productos'), function ($reader) {
            /**
             * $reader->get() nos permite obtener todas las filas de nuestro archivo
             */
            foreach ($reader->get() as $key => $row) {
                $producto = [
                    'codebar'   => $row['Codebar'],
                    'desc'      => $row['Descripcion'],
                    'pcompra'   => $row['Precio_compra'],
                    'pventa'    => $row['Precio_venta'],
                    'total'     => $row['Existencia'],
                    'filtro'    => $row['Filtro'],
                ];
                /** Una vez obtenido los datos de la fila procedemos a registrarlos */
                if (!empty($producto)) {
                    DB::table('productos')->insert($producto);
                } 
            }
            //alert()->success('Straw Hat System', 'Producto registrado correctamente');
            //return Redirect::to('/productos'); 
            
        });
        alert()->success('StrawHat-Systems', 'Alta masiva de productos realizada correctamente');
        return Redirect::to('/producto'); 
    }
}
