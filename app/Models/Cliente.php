<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $id
 * @property string|null $cedula
 * @property string|null $nombre
 * @property string|null $telefono
 * @property string|null $correo
 * @property string|null $direccion
 * @property Carbon|null $fecha_reg
 * 
 * @property Collection|Pago[] $pagos
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	public $timestamps = false;

	protected $casts = [
		'fecha_reg' => 'datetime'
	];

	protected $fillable = [
		'cedula',
		'nombre',
		'telefono',
		'email',
		'direccion',
		'fecha_reg'
	];

	public function pagos()
	{
		return $this->hasMany(Pago::class);
	}
}
