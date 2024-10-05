<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrenteTrabajo
 * 
 * @property int $id
 * @property string $descripcion
 * @property string $area_abarca
 * @property string $coordenadas
 * @property int $organismo_id
 * @property int $municipio_id
 * 
 * @property Organismo $organismo
 * @property Collection|Emergencia[] $emergencias
 *
 * @package App\Models
 */
class FrenteTrabajo extends Model
{
	protected $table = 'frente_trabajo';
	public $timestamps = false;

	protected $casts = [
		'organismo_id' => 'int',
		'municipio_id' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'area_abarca',
		'coordenadas',
		'organismo_id',
		'municipio_id'
	];

	public function organismo()
	{
		return $this->belongsTo(Organismo::class);
	}

	public function emergencias()
	{
		return $this->hasMany(Emergencia::class, 'frente_id');
	}
}
