<div class="collapse" id="collapseExample2" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important; border-top: 3px solid grey;" >
  <div class="card-header">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-primary btn-sm boton-tabla text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
        <strong>Cerrar</strong>
      </a>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <div class="card card-body" style="
      background-image: url('{{ asset('img/blue-white.jpg') }}');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      border-radius: 10px !important;">
        <center>
        	<div class="bg-primary" style="border-radius: 30px;">
          	<img src="{{ asset('img/favicon.png') }}" style="width: 250px;">
        	</div>
          <div class="form-group" style="">
            <div id="img_qr"></div>
          </div>
          <div class="card rounded">
            <div class="form-group">
              <h3 style="color: black !important;"><span id="nombres_carnet"></span> <span id="apellidos_carnet"></span></h3>
            </div>
            <div class="form-group">
              <h5 style="color: black !important;"><span id="email_carnet"></span></h5>
            </div>
            <div class="form-group">
              <h5 style="color: black !important;"><span id="rut_carnet"></span></h5>
            </div>
          </div>
        </center>
      </div>
    </div>
    <div class="col-md-3">
    </div>
  </div>
</div>