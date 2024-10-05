<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagenesEmergencia
 * 
 * @property int $id
 * @property int|null $emergencia_id
 * @property string|null $ruta
 * 
 * @property Emergencia|null $emergencia
 *
 * @package App\Models
 */
class ImagenesEmergencia extends Model
{
	protected $table = 'imagenes_emergencias';
	public $timestamps = false;

	protected $casts = [
		'emergencia_id' => 'int'
	];

	protected $fillable = [
		'emergencia_id',
		'ruta'
	];

	public function emergencia()
	{
		return $this->belongsTo(Emergencia::class);
	}
}
