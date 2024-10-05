<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estructura
 * 
 * @property int $id
 * @property string|null $tipo_estructura
 * 
 * @property Collection|Emergencia[] $emergencias
 *
 * @package App\Models
 */
class Estructura extends Model
{
	protected $table = 'estructuras';
	public $timestamps = false;

	protected $fillable = [
		'tipo_estructura'
	];

	public function emergencias()
	{
		return $this->hasMany(Emergencia::class);
	}
}
