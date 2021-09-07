<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

	protected $table                = 'usuario';
	protected $primaryKey           = 'id';
	
	protected $returnType           = 'array';

	protected $protectFields        = true;
	protected $allowedFields        = ['nombre', 'username', 'password', 'rol_id'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;


	// Callbacks
	/* protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = []; */
}
