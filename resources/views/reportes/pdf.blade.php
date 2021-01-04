<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de ganancias</title>
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/logo.jpg">
      </div>
      <div id="company">
      	<h2 class="name">ABARROTES TUNGUI</h2>
        <div>1er Carril Hornos de Santa Barbara Cda. Kiwi</div>
        <div>5523998752</div>
        <div><a href="">Levi Velazquez Romero</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">REPORTE DE GANANCIAS</div>
          <h2 class="name"></h2>
          <div class="address"></div>
          <div class="email"></div>
        </div>
        <div id="invoice">
          <h1>REPORTE DE GANANCIAS</h1>
          <div class="date">Entre las fechas:</div>
          <div class="date">{{$de}} - {{$a}}</div>
        </div>
      </div>
      	<div><h3></h3></div>
      <table border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="total">FECHA</th>
            <th class="total">DESCRIPCIÓN</th>
            <th class="total">CANTIDAD</th>
            <th class="total">TOTAL COMPRA</th>
          </tr>
        </thead>
        <tbody>
          <?php $dinero=0.0;?>
            @foreach($reporte as $r)
                <tr>  
                    <td>{{$r->fecha}}</td>
                    <td>{{$r->desc}}</td>
                    <td>{{$r->cantidad}} {{$r->unidad}}</td>
                    <td style="text-align: right;">${{number_format($r->precio, 2, '.', ',')}}</td>
                </tr>
            <?php $dinero+= $r->precio;?>
            @endforeach
                <tr>  
                  <td colspan="2" class="total" style="text-align: right;">Total en dinero de todos los productos vendidos
</td>
                  <td colspan="2" style="text-align: right;">${{number_format($dinero, 2, '.', ',')}}</td>
                </tr>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
      <hr>  
      <table border="1" cellspacing="0" cellpadding="0"> 
         <thead>
            <tr> 
              <th class="total">CONCEPTO</th>
              <th class="total">MONTO</th> 
            </tr>
         </thead>
         <tbody>  
            <?php $descuento=0.0;?>
            @foreach($descuentos as $d)
             <tr>
                    <td>{{$d->concepto}}</td>
                    <td style="text-align: right;">${{number_format($d->monto, 2, '.', ',')}}</td>
                    <?php
                      $descuento+=$d->monto;
                    ?>
              </tr>
            @endforeach
            <tr>  
              <td  class="total" style="text-align: right;">Total Descuentos</td>
              <td style="text-align: right;">${{number_format($descuento, 2, '.', ',')}}</td>
            </tr>
         </tbody>
      </table>
      <table  border="1" cellspacing="0" cellpadding="0"> 
        <thead> 
            <tr>  
                <td  class="total" style="text-align: right;">GANANCIAS TOTALES</td>
              <td style="text-align: right;">${{number_format($dinero-$descuento, 2, '.', ',')}}</td>
            </tr>
        </thead>
      </table>
    </main>
    <footer>
      Hecho por Fernando López Servín y Saúl Vazquez Velazquez
    </footer>
  </body>
</html>