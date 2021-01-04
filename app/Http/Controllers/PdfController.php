<?php

namespace AbarrotesSys\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use Redirect;
use NumerosEnLetras;
use AbarrotesSys\Producto;
use AbarrotesSys\Descuento;
use AbarrotesSys\Reporte;
use AbarrotesSys\Venta;
use AbarrotesSys\Dvp;


class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folio)
    {
        $total=0.0;
        $busqueda=$folio;
        $datos=Venta::find($folio);
        $fecha=Venta::find($folio);
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio')
                    ->where('ventas.folio','=',$busqueda)
                    ->get();
                    foreach ($tabla as $p) {
                        $total+=$p->precio*$p->cantidad;
                    }
                    $letras = NumerosEnLetras::convertir($total,'',true);
                    $view =     \View::make('ventas.pdf', compact('tabla','datos','letras','fecha'))->render();
                    $pdf =      \App::make('dompdf.wrapper');
                    $pdf->loadHTML($view);
                    $pdf->setPaper('A4', 'portrait');
                    return $pdf->stream("Venta".$folio.".pdf");
                    return $total;
    }

    /*
     * Metodo para generar el reporte en PDF 
     */
    public function reportePdf($id)
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

        $view =     \View::make('reportes.pdf', compact('de','a','reporte','descuentos','idreporte'))->render();
                $pdf =      \App::make('dompdf.wrapper');
                $pdf->loadHTML($view);
                $pdf->setPaper('A4', 'portrait');
                return $pdf->stream("Reporte.pdf");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
