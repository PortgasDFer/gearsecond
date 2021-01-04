<?php

namespace AbarrotesSys\Http\Controllers;

use  AbarrotesSys\Deudor;
use  AbarrotesSys\Deuda;
use  AbarrotesSys\Venta;
use Alert;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeudoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('deudores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deudores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deudor=new Deudor();
        $deudor->nombre=$request->input('nombre');
        $deudor->apellidos=$request->input('apellido');
        $deudor->estado=0;
        $deudor->save();

        alert()->success('StrawHat-Systems', 'Deudor registrado correctamente');
        return Redirect::to('/deudores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deudor=Deudor::find($id);

        $deudas=    DB::table('deudas')
                    ->join('ventas','deudas.folio','=','ventas.folio')
                    ->select('ventas.fecha','deudas.folio','deudas.monto','deudas.id_deudor')
                    ->where('deudas.id_deudor','=',$deudor->id)
                    ->get();
       alert()->success('StrawHat-Systems', 'Deudas');
       return view('deudores.deudas',compact('deudor','deudas'));
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
