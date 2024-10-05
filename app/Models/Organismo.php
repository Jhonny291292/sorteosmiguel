<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organismo
 * 
 * @property int $id
 * @property string $nombre
 * @property string $responsable
 * @property string $telefono
 * 
 * @property Collection|FrenteTrabajo[] $frente_trabajos
 *
 * @package App\Models
 */
class Organismo extends Model
{
	protected $table = 'organismos';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'responsable',
		'telefono'
	];

	public function frente_trabajos()
	{
		return $this->hasMany(FrenteTrabajo::class);
	}
}
