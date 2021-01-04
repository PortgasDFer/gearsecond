<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/producto','ProductosController');
Route::get('/obtenerProducto/{producto}','ProductosController@obtenerDatos')->name('obtenerDatos');

Route::get('api/productos',function(){
	return datatables()
		->eloquent(AbarrotesSys\Producto::query()
								->where('productos.baja','<>',1)
				  )
		->addColumn('btn','productos.editBtn')
		->addColumn('btnD','productos.delete')
		->addColumn('btnadd','productos.addBtn')
		->rawColumns(['btn','btnD','btnadd'])
		->toJson();
});

Route::get('api/producto',function(){
	return datatables()
		->eloquent(AbarrotesSys\Producto::query()
								->where('productos.baja','<>',1)
			 	  )
		->addColumn('btn','productos.editBtn')
		->addColumn('btnadd','productos.addBtn')
		->rawColumns(['btn','btnadd'])
		->toJson();
});


Route::get('api/urgentes',function(){
	return datatables()
		->eloquent(AbarrotesSys\Producto::query()
								->whereRaw('filtro > total')
			 	  )
		->addColumn('btn','productos.editBtn')
		->addColumn('btnadd','productos.addBtn')
		->rawColumns(['btn','btnadd'])
		->toJson();
});
Route::put('/productoAdd/{producto}/','ProductosController@sumar')->name('producto.suma');
Route::get('/producto/{producto}/add','ProductosController@add')->name('producto.add');
Route::get('/inventario','ProductosController@inventarioIndex')->name('productos.inventario');
Route::get('/masiva','ProductosController@masiva')->name('productos.masiva');
Route::post('/altamasiva','ProductosController@import')->name('import.productos');

/**
 * Rutas venta
 */

Route::resource('/venta','VentasController');
Route::get('/indexventas/','VentasController@indventas')->name('ventas.indexof');
Route::resource('/dvp','DvpController');

Route::get('api/ventas',function(){
	return datatables()
		->eloquent		(AbarrotesSys\Venta::query()
							->where('ventas.baja','>',0)
							->orderBy('ventas.folio','desc')
						)
		->addColumn('eliminar','ventas.deletebtn')
		->addColumn('pdf','ventas.pdfbtn')
		->rawColumns(['eliminar','pdf'])
		->toJson();
});

Route::get('api/venta',function(){
	return datatables()
		->eloquent		(AbarrotesSys\Venta::query()
							->where('ventas.baja','>',0)
							->orderBy('ventas.folio','desc')
						)
		->addColumn('pdf','ventas.pdfbtn')
		->rawColumns(['pdf'])
		->toJson();
});



Route::resource('/pdfv','PdfController');




Route::get('api/reportes',function(){
	return datatables()
		->eloquent(AbarrotesSys\Reporte::query()
								->where('reportes.estado','<>',1)
			 	  )
		->addColumn('ver','reportes.ver')
		->addColumn('pdf','reportes.pdfbtn')
		->addColumn('delete','reportes.delete')
		->rawColumns(['ver','pdf','delete'])
		->toJson();
});


Route::get('/reportes', function () {
    return view('reportes.index');
});

Route::get('/nuevo',function(){
	return view('reportes.nuevo');
});

Route::post('/generar','ReportesController@generar')->name('generar');

Route::post('/descuento','ReportesController@descuento')->name('descuento');

Route::delete('/eliminar/{descuento}','ReportesController@eliminarDescuento')->name('eliminarDescuento');

Route::delete('/delete/{reporte}','ReportesController@eliminarReporte')->name('eliminarReporte');

Route::get('/pdfr/{reporte}','PdfController@pdfReporte')->name('pdfr');

Route::get('/ver/{reporte}','ReportesController@verReporte')->name('verreporte');

Route::get('/generarpdf/{reporte}','PdfController@reportePdf')->name('generarreporte');

Route::resource('/deudores','DeudoresController');

Route::get('api/deudores',function(){
	return datatables()
		->eloquent(AbarrotesSys\Deudor::query()
								->where('deudores.estado','<>',1)
			 	  )
		->addColumn('ver','deudores.ver')
		->addColumn('delete','deudores.delete')
		->rawColumns(['ver','delete'])
		->toJson();
});

Route::get('/finalizar','ReportesController@finalizar')->name('finalizar');
Route::post('/nuevoDeudor', 'DvpController@nuevoDeudor')->name('nuevoDeudor');
Route::post('/registrarDeudor', 'DvpController@registrarDeudor')->name('registrarDeudor');
Route::post('/asignarDeudor', 'DvpController@asignarDeudor')->name('asignarDeudor');

Route::resource('/deuda','DeudasController');