<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Redirect;
use AbarrotesSys\Deuda;

class DeudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deudas =    DB::table('ventas')
                    ->join('deudas','ventas.folio','=','deudas.folio')
                    ->join('deudores','deudas.id_deudor','=','deudores.id')
                    ->select('ventas.fecha','deudores.nombre','deudores.apellidos','ventas.folio','deudas.id')
                    ->orderBy('id', 'desc')
                    ->get();

        alert()->success('Straw Hat System', 'Deudas pendientes');
        return view('deudas.index',compact('deudas'));
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
    public function show($id)
    {
        //
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
        $deuda=Deuda::find($id);
        $deuda->delete();
        alert()->warning('Straw Hat System', 'Deuda Eliminada, asegurese de haberla cobrado.')->persistent('Entendido');
        return Redirect::to('/home');
    }
}
