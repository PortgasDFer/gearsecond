<?php

namespace AbarrotesSys\Http\Controllers;

use  AbarrotesSys\Producto;
use Alert;
use Redirect,Response;;
use Illuminate\Http\Request;
use  AbarrotesSys\Imports\ProductoImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto=new Producto();
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $foto = time().$file->getClientOriginalName();
            $file->move(public_path().'/productosimg/',$foto);
            $producto->foto=$foto;
        }
        $producto->codebar=$request->input('codebar');
        $producto->desc=$request->input('desc');
        $producto->unidad=$request->input('unidad');
        $producto->total=$request->input('total');
        $producto->pcompra=$request->input('pcompra');
        $producto->pventa=$request->input('pventa');
        $producto->filtro=$request->input('filtro');
        $producto->baja=0;
        $producto->save();
        alert()->success('StrawHat-Systems', 'Producto registrado correctamente');
        return Redirect::to('/producto');
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

    /*
    Función para obtener datos mediante el escaner del codigo de barras.
     */
    public function obtenerDatos($codebar)
    {
        $producto = Producto::find($codebar);
        //$nombre=$producto->desc;
        return Response::json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codebar)
    {
        $producto=Producto::find($codebar);
        return view('productos.editar',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codebar)
    {
        $producto=Producto::find($codebar);
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $foto = time().$file->getClientOriginalName();
            $file->move(public_path().'/productosimg/',$foto);
            $producto->foto=$foto;
        }
        $producto->desc=$request->input('desc');
        $producto->total=$request->input('total');
        $producto->unidad=$request->input('unidad');
        $producto->pcompra=$request->input('pcompra');
        $producto->pventa=$request->input('pventa');
        $producto->filtro=$request->input('filtro');
        $producto->save();
        alert()->success('StrawHat-Systems', 'Producto editado correctamente');
        return Redirect::to('/producto');

    }

    /**
     * Baja lógica del sistema campo "baja" cambia a 1 y se deja de mostrar en la tabla.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($codebar)
    {
        $producto=Producto::find($codebar);
        $producto->baja=1;
        $producto->save();
        alert()->warning('StrawHat-Systems', 'Producto eliminado correctamente');
        return Redirect::to('/producto');
    }

    /**
     * [Muestra el formulario para realizar una alta masiva de productos mediante un archivo de Excel]
     * @return [\Illuminate\Http\Response] []
     */
    public function masiva()
    {
        return view('productos.masiva');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductoImport, request()->file('productos'));
        
        
        return redirect('/producto')->with('success', 'All good!');
    }

    public function add($codebar){
        $producto=Producto::find($codebar);
        return view('productos.add',compact('producto'));
    }

    public function inventarioIndex()
    {
        return view('inventario.index');
    }

    public function sumar(Request $request, $codebar)
    {
        $producto=Producto::find($codebar);

        $existente=$producto->total;

        $nueva=$request->input('cantidad');

        $total=$existente+$nueva;

        $producto->total=$total;

        $producto-> save();

        alert()->success('StrawHat-Systems', 'Cantidad agregada satisfactoriamente');
        return Redirect::to('/inventario');
    }
}
