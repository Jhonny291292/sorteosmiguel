<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Emergencia
 * 
 * @property int $id
 * @property string|null $sector
 * @property string|null $coordenadas
 * @property int|null $parroquia_id
 * @property int|null $municipio_id
 * @property int|null $frente_id
 * @property string|null $situacion
 * @property string|null $causas
 * @property string|null $status
 * @property string|null $personas_afectadas
 * @property string|null $descripcion
 * @property string|null $heridos
 * @property string|null $fallecidos
 * @property string|null $desaparecidos
 * @property string|null $familias_afectadas
 * @property int|null $estructura_id
 * @property string|null $estructura_afectcantidad
 * @property string|null $fecha_evento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Municipio|null $municipio
 * @property Parroquia|null $parroquia
 * @property FrenteTrabajo|null $frente_trabajo
 * @property Estructura|null $estructura
 * @property Collection|ImagenesEmergencia[] $imagenes_emergencias
 *
 * @package App\Models
 */
class Emergencia extends Model
{
	protected $table = 'emergencias';

	protected $casts = [
		'parroquia_id' => 'int',
		'municipio_id' => 'int',
		'frente_id' => 'int',
		'estructura_id' => 'int'
	];

	protected $fillable = [
		'sector',
		'coordenadas',
		'parroquia_id',
		'municipio_id',
		'frente_id',
		'situacion',
		'causas',
		'status',
		'personas_afectadas',
		'descripcion',
		'heridos',
		'fallecidos',
		'desaparecidos',
		'familias_afectadas',
		'estructura_id',
		'estructura_afectcantidad',
		'fecha_evento'
	];

	public function municipio()
	{
		return $this->belongsTo(Municipio::class);
	}

	public function parroquia()
	{
		return $this->belongsTo(Parroquia::class);
	}

	public function frente_trabajo()
	{
		return $this->belongsTo(FrenteTrabajo::class, 'frente_id');
	}

	public function estructura()
	{
		return $this->belongsTo(Estructura::class);
	}

	public function imagenes_emergencias()
	{
		return $this->hasMany(ImagenesEmergencia::class);
	}
}
