<?php

namespace App\Controllers\API;

use App\Models\TransaccionModel;
use App\Models\CuentaModel;
use CodeIgniter\RESTful\ResourceController;

class Transacciones extends ResourceController
{
	public function __construct()
	{
		$this->model = $this->setModel(new TransaccionModel());
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$transacciones = $this->model->findAll();
		return $this->respond($transacciones);
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		try {
			$transaccion =  $this->request->getJSON();
			if($this->model->insert($transaccion)):
				$transaccion->id = $this->model->insertID();
				$transaccion->resultado = $this->actualizarFondoCuenta($transaccion->tipo_transaccion_id, $transaccion->monto, $transaccion->cuenta_id);
				return $this->respondCreated($transaccion);
			else:
				return $this->failValidationErrors($this->model->validation->listErrors());
			endif;
		} catch (\Exception $e) {
			return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
		}
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		//
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		//
	}

	private function actualizarFondoCuenta($tipoTransaccionId, $monto, $cuentaId)
	{
		$modelCuenta = new CuentaModel();
		$cuenta = $modelCuenta->find($cuentaId);

		switch ($tipoTransaccionId) {
			case 1:
				$cuenta["fondo"] += $monto;
				break;
			case 2:
				$cuenta["fondo"] += $monto;
				break;
		}

		if($modelCuenta->update($cuentaId, $cuenta)):
			return array('TransaccionExitosa' => true, 'NuevoFondo' => $cuenta["fondo"]);
		else : 
			return array('TransaccionExitosa' => false, 'NuevoFondo' => $cuenta["fondo"]);
		endif;
	}
}
