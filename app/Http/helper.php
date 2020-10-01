<?php
function status()
{
	if (\Auth::user()->tipo_usuario == 'Empleado' || \Auth::user()->tipo_usuario == 'Admin') {
		$buscar_status=\DB::table('empleados')
		->join('users','users.id','=','empleados.id_usuario')
		->where('users.id',\Auth::user()->id)
		->select('empleados.status')
		->get();

		foreach ($buscar_status as $key) {
			$status = $key->status;
		}
		return $status;
	}else if(\Auth::user()->tipo_usuario == 'Cliente'){
		$buscar_status=\DB::table('clientes')
		->join('users','users.id','=','clientes.id_usuario')
		->where('users.id',\Auth::user()->id)
		->select('clientes.status')
		->get();

		foreach ($buscar_status as $key) {
			$status = $key->status;
		}
		return $status;
	}
}