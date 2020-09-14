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
      <?php $image_path = '/img/naturandes.jpg'; ?>
      <img src="{{ public_path() . $image_path }}" class="logo">
      <b style="font-size: 20px; margin-top: 20px;">
        República Bolivariana de Venezuela<br>
       </b>
      Asociación Civil Real Victoria<br>
      Rif: J-40153589-5
      <p align="right">Fecha: <?php echo date('d/m/Y h:m A'); ?></p>
    </p>
  </header>
  
  <div class="content">
    <h1>Carnet único de cliente de Naturandes</h1>
    <hr>
    <div class="contenido">
        <p id="primero">Hola, Bienvenido Sr(a). Antoni León. Gracias por formar parte de nuestra familia de Naturandes, para hacer sus compras mucho
         mejo y en el menor tiempo posibles hemos mejorado nuestra atención, por eso le traemos nuestro nuevo carnet con código QR de Naturandes.</p>
        <div class="carnet">          
          <div class="card border shadow" style="
          background-image: url('{{ asset('img/blue-white.jpg') }}');
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;">
            <div class="card-body">
              <center>
                <div class="" style="border-radius: 30px; background: #007bff; margin: 15px;">
                  <img src="{{ asset('img/favicon.png') }}" style="width: 250px;">
                </div>
                <div class="form-group" style="">
                  <img src="{{ asset('img/qr-code/11122233-1.png') }}" style="width: 200px;">
                </div>
                <div class="card rounded" style="margin: 15px;">
                  <p>
                    <span>Antoni León</span><br>
                    <span>a.leon@eiche.cl</span><br>
                    <span>12345678-9</span>
                  </p>
                </div>
              </center>
            </div>
          </div>
        </div>
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
            <h5 style="text-align: right;">Impreso por: {{ \Auth::User()->email }}</h5>
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
</html>