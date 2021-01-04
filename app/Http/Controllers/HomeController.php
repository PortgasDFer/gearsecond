<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use AbarrotesSys\Venta;
use AbarrotesSys\Deuda;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $numventas=Venta::count();
        $ventas=Venta::orderBy('folio', 'DESC')
            ->take(5)
            ->get();
        $numdeudas=Deuda::count();

        $deudas =    DB::table('ventas')
                    ->join('deudas','ventas.folio','=','deudas.folio')
                    ->join('deudores','deudas.id_deudor','=','deudores.id')
                    ->select('ventas.fecha','deudores.nombre','deudores.apellidos','ventas.folio','deudas.id','deudas.monto')
                    ->orderBy('id', 'desc')
                    ->get();

        $request->user()->authorizeRoles(['user', 'admin']);
        return view('home',compact('numventas','numdeudas','deudas','ventas'));
    }
}
