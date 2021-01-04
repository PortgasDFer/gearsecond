<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Nota de venta</title>
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img/logo.jpg">
      </div>
      <div id="company">
      	<h2 class="name">ABARROTES TUNGUI </h2>
        <div>1er Carril Hornos de Santa Barbara Cda. Kiwi</div>
        <div>5523998752</div>
        <div><a href="">Levi Velazquez Romero</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">NOTA DE VENTA</div>
          <h2 class="name"></h2>
          <div class="address"></div>
          <div class="email"></div>
        </div>
        <div id="invoice">
          <h1>NOTA DE VENTA</h1>
          <div class="date">Folio: {{$datos->folio}}</div>
          <div class="date">Fecha: {{$fecha->created_at->format('d/m/Y')}}</div>
        </div>
      </div>
      	<div><h3></h3></div>
      <table border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="total">CANTIDAD</th>
            <th class="total">DESCRIPCIÓN</th>
            <th class="total">PRECIO UNIT.</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php $sum=0.0;?>
            @foreach($tabla as $t)
                <tr>  
                    <td>{{$t->cantidad}}</td>
                    <td>{{$t->desc}}</td>
                    <td style="text-align: right;">$     {{number_format($t->precio, 2, '.', ',')}}</td>
                    <td style="text-align: right;">$     {{number_format($t->precio*$t->cantidad, 2, '.', ',')}} </td>
                </tr>
            <?php $sum+= $t->precio*$t->cantidad;?>
            @endforeach
            <tr><td colspan="2" style="border: none;"></td>  
                <td class="total" style="text-align: right;">SUBTOTAL $</td>
                <td style="text-align: right;">{{number_format($sum-($sum*0.16), 2, '.', ',')}}</td>
            </tr>
            <tr><td colspan="2"  style="border: none;"></td>  
                <td class="total" style="text-align: right;">IVA  $</td>
                <td style="text-align: right;"> {{number_format($sum*0.16, 2, '.', ',')}} </td>
            </tr>
            <tr>
              <td colspan="2"  style="border: none;"></td>  
                <td class="total" style="text-align: right;">TOTAL  $</td>
                <td style="text-align: right;">{{number_format(($sum*0.16)+($sum-($sum*0.16)), 2, '.', ',')}}</td>  
            </tr>
            <tr>
              <td class="total" style="text-align: right;">TOTAL CON LETRA</td>
              <td colspan="3">{{$letras}}</td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </main>
    <footer>
      Hecho por Fernando López Servín y Saúl Vazquez Velazquez
    </footer>
  </body>
</html>