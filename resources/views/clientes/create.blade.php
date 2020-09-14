@extends('layouts.app')
@section('css')
<title>Registro de cliente</title>
@endsection
@section('content')
<div class="content">
  <div class="breadcrumb-wrapper">
    <h1>Clientes</h1>           
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb p-0">
        <li class="breadcrumb-item">
          <a href="index.html"><span class="mdi mdi-home"></span></a>
        </li>
        <li class="breadcrumb-item">Clientes</li>
        <li class="breadcrumb-item" aria-current="page">Registrar clientes</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Registro de cliente</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('clientes.store') }}" name="registro_clientes" method="POST">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="apellidos">Apeliidos</label>
                  <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="rut">RUT</label>
                      <input type="text" class="form-control" placeholder="Ingrese RUT" name="rut" id="rut" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" id="exampleFormControlSelect12" name="status">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-footer pt-5 border-top">
              <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-default">Regresar</a>
              <button type="submit" class="btn btn-success btn-default">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
