<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parroquia
 * 
 * @property int $id
 * @property string $descripcion
 * @property int $municipio_id
 * 
 * @property Municipio $municipio
 * @property Collection|Emergencia[] $emergencias
 *
 * @package App\Models
 */
class Parroquia extends Model
{
	protected $table = 'parroquias';
	public $timestamps = false;

	protected $casts = [
		'municipio_id' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'municipio_id'
	];

	public function municipio()
	{
		return $this->belongsTo(Municipio::class);
	}

	public function emergencias()
	{
		return $this->hasMany(Emergencia::class);
	}
}
