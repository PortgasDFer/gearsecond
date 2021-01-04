<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use AbarrotesSys\Venta;
use Alert;
use Redirect;
use AbarrotesSys\Reporte;
use AbarrotesSys\Descuento;
use AbarrotesSys\Producto;

class ReportesController extends Controller
{
    public function index()
    {
        $reportes=Reporte::all();
        return view('reportes.index',compact('reportes'));
    }
    /*
    Generar Reportes
     */
    public function generar(Request $request)
    {
        $de=$request->input('fecha1');
    	$a=$request->input('fecha2');
    	//$reporte=Venta::whereBetween('fecha', [$de, $a])->get();
    	$reporte =	DB::table('ventas')
    				->join('dvp','ventas.folio','=','dvp.folio_v')
    				->join('productos','dvp.codebar','=','productos.codebar')
    				->select('ventas.fecha','productos.desc','productos.unidad','dvp.cantidad','dvp.precio')
    				->whereBetween('ventas.fecha', [$de, $a])
    				->get();
    	//return $reporte;
    	/*
        $reportebase= un objeto tipo reporte que se inserta a la base de datos.   
         */
        $reportebase = new Reporte();
        $reportebase->fecha1=$request->input('fecha1');
        $reportebase->fecha2=$request->input('fecha2');
        $reportebase->estado=0;
        $reportebase->save();

        $idreporte=$reportebase->id;
        alert()->success('Straw Hat System', 'Resultado de la consulta');
    	return view('reportes.preeliminar',compact('reporte','de','a','idreporte'));
    }

    /*
        Metodo para agregar descuentos a las ganancias
     */
    public function descuento(Request $request)
    {
        $descuento=new Descuento();
        
        $id_reporte=$request->input('id_reporte');
        $r= Reporte::find($id_reporte);
        $de=$r->fecha1;
        $a=$r->fecha2;
        $idreporte=$r->id;

        $descuento->concepto=$request->input('concepto');
        $descuento->monto=$request->input('monto');
        $descuento->id_reporte=$request->input('id_reporte');
        $descuento->save();

        $idreporte=$r->id;

        $reporte =  DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','dvp.codebar','=','productos.codebar')
                    ->select('ventas.fecha','productos.desc','dvp.unidad','dvp.cantidad','dvp.precio')
                    ->whereBetween('ventas.fecha', [$de, $a])
                    ->get();

        $descuentos=Descuento::where('id_reporte','=',$id_reporte)->get();
        alert()->success('Straw Hat System', 'Descuento agregado correctamente');
        return view('reportes.reporte',compact('reporte','de','a','descuentos','idreporte'));

    }

    /*
        Metodo para eliminar descuentos a las ganancias
     */
    public function eliminarDescuento($id)
    {
        $descuento=Descuento::find($id);
        $r=Reporte::find($descuento->id_reporte);
        $de=$r->fecha1;
        $a=$r->fecha2;
        $idreporte=$r->id;
        $reporte =  DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','dvp.codebar','=','productos.codebar')
                    ->select('ventas.fecha','productos.desc','dvp.unidad','dvp.cantidad','dvp.precio')
                    ->whereBetween('ventas.fecha', [$de, $a])
                    ->get();
        $descuento->delete();
        $descuentos=Descuento::where('id_reporte','=',$idreporte)->get();
        alert()->warning('Straw Hat System', 'Descuento eliminado');
        return view('reportes.reporte',compact('reporte','de','a','descuentos','idreporte'));
    }


    /*
        Metodo eliminación de reportes
     */
    public function eliminarReporte($id)
    {
       $reporte=Reporte::find($id);
       $reporte->estado=1;
       $reporte->save();
       alert()->warning('Straw Hat System', 'Reporte eliminado');
       return Redirect::to('/reportes');
    }

    /*
     *   Metodo vista previa reportes (podemos usar el mismo metodo para jalar los datos al pdf)   
     */
    
    public function verReporte($id)
    {
        $r= Reporte::find($id);
        $de=$r->fecha1;
        $a=$r->fecha2;
        $idreporte=$r->id;
        $reporte =  DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','dvp.codebar','=','productos.codebar')
                    ->select('ventas.fecha','productos.desc','dvp.unidad','dvp.cantidad','dvp.precio')
                    ->whereBetween('ventas.fecha', [$de, $a])
                    ->get();

        $descuentos=Descuento::where('id_reporte','=',$idreporte)->get();

        alert()->success('Straw Hat System', 'Estadisticas del reporte');
        return view('reportes.previa',compact('reporte','de','a','descuentos','idreporte'));
    }

    public function finalizar()
    {
        alert()->success('Straw Hat System', 'Reporte generado con éxito');
        return view('reportes.index');
    }
}
