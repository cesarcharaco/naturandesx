<html>
<head>
  @yield('css')
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { 
      position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: ;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    a {
        text-decoration: none;
        color: black;
    }

    table td {
        padding: 5px;
    }
    th {
        text-align: center;
    }
    .logo {
      width: 100px;
      height: 100px;
      margin-right: 250px;
      margin-top: 20px;
      position: absolute;
    }

    .text-right {
      text-align: right;
    }
    h1{
      text-align: center;
      text-transform: uppercase;
    }
    .contenido{
      font-size: 20px;
    }
    #primero{
      text-align: justify;
    }
    .card {
      border: none;
      border-radius: 4px;
      background-color: #fff;
      -webkit-transition: all 0.3s ease 0s;
      transition: all 0.3s ease 0s;
    }
    .carnet {
      border: solid #000 1px;
      width: 50%;
      margin-right: auto;
      margin-left: auto;
    }
  </style>
<body>

  <header>
    <p align="center">
      
      <img src="{{ asset('img/naturandes.jpg') }}" class="logo">
      <b style="font-size: 20px; margin-top: 20px;">
        Naturandes - Es Tritan<br>
       </b>
      Horario del Call Center<br>
      Lu-VI: 8:30-18:00
      Sa: 8:30-14:00
      Do: cerrado
      <?php
        // $fecha= date('d/m/Y h:m A');
        $fecha= date('d-m-Y h:m A'); 
        $fecha2 = strtotime('-1 hour',strtotime($fecha));
        $fecha2 = date('d/m/Y h:m A',$fecha2); 
      ?>
      <p align="right">Fecha: <?php echo $fecha2; ?></p>
    </p>
  </header>
  
  <div class="content">
    <h4 align="center">Reporte de ventas de repartidores</h4>
    <hr>
    <div class="contenido">
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <thead>
        <tr style="font-size: 12px;">
          <th>Repartidor</th>
          <th>Cliente</th>
          <th>Promoción</th>
          <th>Cantidad</th>
          <th>Monto total</th>
          <th>Status</th>
          <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
          @foreach($consultar_ventas as $key)
          <tr style="font-size: 12px;">
            <td>{{$key->empleado->nombres}} {{$key->empleado->apellidos}}</td>
            <td>{{$key->venta->cliente->nombres}} {{$key->venta->cliente->apellidos}}</td>
            <td>{{$key->venta->promociones->promocion}}</td>
            <td>{{$key->venta->cantidad}}</td>
            <td>{{$key->venta->monto_total}}.00&#36;</td>
            <td>{{$key->status}}</td>
            <td>{{$key->created_at}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <table>
      <tr>
        <td>
          <p class="izq">
            <a href="https://www.naturandes.cl" target="_blank">naturandes.cl</a>
          </p>
          Dirección: Ignacio Carrera Pinto 651, Copiapó, III Región.
          info@naturandes.cl telef. +52 222 1297. <br>
            <h5 style="text-align: right;">Impreso por: {{\Auth::User()->email}} </h5>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>


</body>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/line-chart.js') }}"></script>
</html>