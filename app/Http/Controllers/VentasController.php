<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use AbarrotesSys\Venta;
use Alert;
use Redirect;
use AbarrotesSys\Producto;
use AbarrotesSys\Deudor;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ventas.index');
    }
    public function indventas()
    {
        alert()->success('Straw Hat System', 'Venta realizada con éxito');
        return Redirect::to('/venta');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foliobase=Venta::select('folio')->orderby('folio','DESC')->first();
        $folionuevo=substr($foliobase,10,-8);
        $numero=substr($foliobase, 14,-2);
        $contador=$numero+1;
        $siguientefolio=$folionuevo.$contador;
        $fechaactual=now()->toDateString();
        //return $foliobase;
        return view('ventas.realizar',compact('siguientefolio','fechaactual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta=new Venta();
        $folio=$venta->folio=$request->input('folio');
        $venta->folio=$request->input('folio');
        $venta->fecha=$request->input('fecha');
        $venta->baja=1;
        $venta->save();

        $datos=Venta::find($folio);
        $deudores=Deudor::all();

        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        $productos=Producto::all();

        alert()->success('Straw Hat System', 'Agregue los productos');
        return view('ventas.agregar',compact('datos','tabla','productos','deudores'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folio)
    {
        $datos=Venta::find($folio);
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.unidad','dvp.precio','dvp.id','ventas.folio')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        alert()->success('Straw Hat System', 'Datos de la venta');
        return view('ventas.revisar',compact('datos','tabla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($folio)
    {
        /*
                Inutilizable para la funcionalidad del sistema.

        */
        //$venta=Venta::find($folio);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $folio)
    {
        $venta=Venta::find($folio);
        $venta->baja=0;
        $venta->save();
        alert()->warning('Straw Hat System', 'Venta Eliminada');
        return Redirect::to('/venta');
    }
}
