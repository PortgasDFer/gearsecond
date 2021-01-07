<?php

namespace AbarrotesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Redirect;
use AbarrotesSys\Producto;
use AbarrotesSys\Venta;
use AbarrotesSys\Dvp;
use AbarrotesSys\Granel;
use AbarrotesSys\Deudor;
use AbarrotesSys\Deuda;

class DvpController extends Controller
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
        /*
        Obtenemos los datos generales de la nota de venta
        Y elementos necesarios para seguir agregando productos
        El objeto $producto  se consulta según el producto agregado.
        Con el podemos hacer la estructura de control para convertir kilogramos a gramos y gramos a kilogramos, para así descontar las cantidades correctas del inventario.

         */
        $folio=$request->input('folio');
        $deudores=Deudor::all();
        $codebar=$request->input('codebar');
        $producto=Producto::find($codebar);
        $existente=$producto->total;
        $productos=Producto::all();
        $datos=Venta::find($folio);
        
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        foreach ($tabla as $t) {
            if($t->codebar==$codebar){
                $dvp=Dvp::find($t->id);
                $dvp->cantidad+=1;
                $dvp->save();
                $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();
                alert()->success('Straw Hat System', 'Producto agregado');
            return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }
        }

        $dvp=new Dvp();
 		$restante=$request->input('cantidad');
        $dvp->folio_v=$request->input('folio');
        $dvp->codebar=$request->input('codebar');
        $dvp->precio=$request->input('precio');
        $dvp->unidad=$request->input('unidad');
        $dvp->cantidad=$request->input('cantidad');

        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','dvp.unidad','productos.codebar')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        /*Obtenemos la cantidad en inventario del producto*/
        if($producto->unidad=="Kg"){
            if($dvp->unidad=="Gr"){
                $gramos=$producto->total*1000;
                $existente=$gramos;
            }elseif($dvp->unidad=="Gr"){
                $existente=$producto->total;
            }
        }elseif($producto->unidad=="Gr"){
            if($dvp->unidad=="Kg"){
                $kilogramos=$producto->total/1000;
                $existente=$kilogramos;
            }elseif($dvp->unidad="Gr"){
                $existente=$producto->total;
            }
        }elseif($producto->unidad=="Pza"){
            if($dvp->unidad=="Kg"){
                alert()->error('Straw Hat System', 'El producto solicitado no tiene unidad de medida a Granel.');
                return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }elseif($dvp->unidad=="Gr"){
                alert()->error('Straw Hat System', 'El producto solicitado no tiene unidad de medida a Granel.');
                return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }elseif($dvp->unidad=="Pza"){
                $existente=$producto->total;
            }   
        }
        /*Consultamos que contemos con más cantidad que la que se vendera*/
         if($existente<$restante){
            /*Si no contamos con mayor cantidad el sistema arrojará un mensaje de alerta y no permitira agregar el producto.*/
            alert()->error('Straw Hat System', 'No cuenta con esa cantidad de producto');
            return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
         }elseif($existente>=$restante){
            /*Si hay mayor cantidad en inventario que la que se vendera comprobamos las unidades de medida y ejecutamos las formulas de conversión correspondientes.*/
            if($producto->unidad=="Kg"){
                if($dvp->unidad=="Gr"){
                    $gramos=$producto->total*1000;
                    $total=$gramos-$restante;
                    $producto->total=$total/1000;
                    $producto->save();
                }elseif($dvp->unidad=="Kg"){
                    $producto->total=$existente-$restante;
                    $producto->save();
                }
            }elseif($producto->unidad=="Gr"){
                if($dvp->unidad=="Kg"){
                    $kilogramos=$producto->total/1000;
                    $total=$kilogramos-$restante;
                    $producto->total=$total*1000;
                    $producto->save();
                }elseif($dvp->unidad=="Gr"){
                    $producto->total=$existente-$restante;
                    $producto->save();
                }
            }elseif($producto->unidad=="Pza"){
                $producto->total=$existente-$restante;
                $producto->save();
            }
         }	
        if(empty($dvp->precio)){
            /*En caso de no agregar precio al producto a la hora de realizar la nota de venta, se obtendra el precio previamente asignado al producto.*/
            $dvp->precio=$producto->pventa;
        }
        $dvp->save();
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();
        alert()->success('Straw Hat System', 'Producto agregado');
        return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
        //return $dvp;
        //return $producto;
        //return $tabla;

     //Prueba Granel  
     /** 
        $granel=new Granel();

        $granel->id_granel=$request->input('id_granel');
        $granel->nombre_granel=$request->input('nombre_granel');
        $granel->peso=$request->input('peso');
        $granel->medida=$request->input('medida');
        $granel->precio_granel=$request->input('precio_granel');


        $granel->save();
        
        alert()->success('Straw Hat System', 'Producto agregado');
        return view('ventas.agregar',compact('datos','tabla','granel'));

    */
        

    }

    public function insertAjax(Request $request)
    {
        $folio=$request->input('folio');
        $deudores=Deudor::all();
        $codebar=$request->input('codebar');
        $producto=Producto::find($codebar);
        $existente=$producto->total;
        $productos=Producto::all();
        $datos=Venta::find($folio);
        
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        foreach ($tabla as $t) {
            if($t->codebar==$codebar){
                $dvp=Dvp::find($t->id);
                $dvp->cantidad+=1;
                $dvp->save();
                $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();
                alert()->success('Straw Hat System', 'Producto agregado');
                return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }
        }

        $dvp=new Dvp();
        $restante=$request->input('cantidad');
        $dvp->folio_v=$request->input('folio');
        $dvp->codebar=$request->input('codebar');
        $producto=Producto::find($codebar);
        $dvp->precio=$producto->pventa;
        $dvp->unidad=$producto->unidad;
        $dvp->cantidad=1;

        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','dvp.unidad','productos.codebar')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        /*Obtenemos la cantidad en inventario del producto*/
        if($producto->unidad=="Kg"){
            if($dvp->unidad=="Gr"){
                $gramos=$producto->total*1000;
                $existente=$gramos;
            }elseif($dvp->unidad=="Gr"){
                $existente=$producto->total;
            }
        }elseif($producto->unidad=="Gr"){
            if($dvp->unidad=="Kg"){
                $kilogramos=$producto->total/1000;
                $existente=$kilogramos;
            }elseif($dvp->unidad="Gr"){
                $existente=$producto->total;
            }
        }elseif($producto->unidad=="Pza"){
            if($dvp->unidad=="Kg"){
                alert()->error('Straw Hat System', 'El producto solicitado no tiene unidad de medida a Granel.');
                return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }elseif($dvp->unidad=="Gr"){
                alert()->error('Straw Hat System', 'El producto solicitado no tiene unidad de medida a Granel.');
                return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
            }elseif($dvp->unidad=="Pza"){
                $existente=$producto->total;
            }   
        }
        /*Consultamos que contemos con más cantidad que la que se vendera*/
         if($existente<$restante){
            /*Si no contamos con mayor cantidad el sistema arrojará un mensaje de alerta y no permitira agregar el producto.*/
            alert()->error('Straw Hat System', 'No cuenta con esa cantidad de producto');
            return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
         }elseif($existente>=$restante){
            /*Si hay mayor cantidad en inventario que la que se vendera comprobamos las unidades de medida y ejecutamos las formulas de conversión correspondientes.*/
            if($producto->unidad=="Kg"){
                if($dvp->unidad=="Gr"){
                    $gramos=$producto->total*1000;
                    $total=$gramos-$restante;
                    $producto->total=$total/1000;
                    $producto->save();
                }elseif($dvp->unidad=="Kg"){
                    $producto->total=$existente-$restante;
                    $producto->save();
                }
            }elseif($producto->unidad=="Gr"){
                if($dvp->unidad=="Kg"){
                    $kilogramos=$producto->total/1000;
                    $total=$kilogramos-$restante;
                    $producto->total=$total*1000;
                    $producto->save();
                }elseif($dvp->unidad=="Gr"){
                    $producto->total=$existente-$restante;
                    $producto->save();
                }
            }elseif($producto->unidad=="Pza"){
                $producto->total=$existente-$restante;
                $producto->save();
            }
         }  
        if(empty($dvp->precio)){
            /*En caso de no agregar precio al producto a la hora de realizar la nota de venta, se obtendra el precio previamente asignado al producto.*/
            $dvp->precio=$producto->pventa;
        }
        $dvp->save();
        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();
        alert()->success('Straw Hat System', 'Producto agregado');
        return view('ventas.agregar',compact('datos','tabla','productos','deudores'));
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
    public function destroy(Request $request,$id)
    {
        $folio=$request->input('folio');
        $dvp=Dvp::find($id);
        $codebar=$request->input('codebar');
        $producto=Producto::find($codebar);
        $recuperado=$dvp->cantidad;
        $existencia=$producto->total;
        $total=$existencia+$recuperado;
        $producto->total=$total;
        $producto->save();
        $dvp->delete();
        $datos=Venta::find($folio);

        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        $productos=Producto::all();
        $deudores=Deudor::all();

        alert()->warning('Straw Hat System', 'Fila eliminada');
        return view('ventas.agregar',compact('datos','tabla','productos','deudores'));

        //return $producto;


    }

    /*
    Metodo para dirigir a la vista donde registraremos un nuevo deudor cuando estamos realizando una nota de ventas. 
    Llevamos el folio de la venta para no perder el hilo de lo que estamos haciendo. 
     */
    public function nuevoDeudor(Request $request)
    {
        $folio=$request->input('folio');
        alert()->success('Straw Hat System','Registre nuevo deudor');
        return view('ventas.deudor',compact('folio'));
    }

    /*
    Metodo para registrar deudor desde una nota de venta, al registrarlo regresamos a la nota que estabamos haciendo.
     */
    public function registrarDeudor(Request $request)
    {
        $folio=$request->input('folio');
        $deudor = new Deudor();
        $deudor->nombre=$request->input('nombre');
        $deudor->apellidos=$request->input('apellido');
        $deudor->estado=0;
        $deudor->save();

        $datos=Venta::find($folio);

        $tabla =    DB::table('ventas')
                    ->join('dvp','ventas.folio','=','dvp.folio_v')
                    ->join('productos','productos.codebar','=','dvp.codebar')
                    ->select('productos.desc','dvp.cantidad','dvp.precio','dvp.id','ventas.folio','productos.codebar','dvp.unidad')
                    ->where('ventas.folio','=',$folio)
                    ->get();

        $productos=Producto::all();

        $productos=Producto::all();
        $deudores=Deudor::all();

        alert()->warning('Straw Hat System', 'Deudor registrado!');
        return view('ventas.agregar',compact('datos','tabla','productos','deudores'));

    }

    public function asignarDeudor(Request $request)
    {
        $deuda=new Deuda();
        $deuda->folio=$request->input('folio');
        $deuda->id_deudor=$request->input('id_deudor');
        $deuda->monto=$request->input('monto');
        $deuda->save();

        alert()->warning('Straw Hat System', 'Deuda asignada, recuerde cobrar esta venta, para más detalles vaya a la pagina de inicio')->persistent('Entendido');
        return Redirect::to('/venta');
    }

}
