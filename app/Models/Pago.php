<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 * 
 * @property int $id
 * @property int|null $cliente_id
 * @property int|null $numero
 * @property int|null $user_id
 * @property string|null $monto
 * @property Carbon $fecha
 * @property string|null $estatus
 * 
 * @property Cliente|null $cliente
 * @property User|null $user
 *
 * @package App\Models
 */
class Pago extends Model
{
	protected $table = 'pagos';
	public $timestamps = false;

	protected $casts = [
		'cliente_id' => 'int',
		'numero' => 'int',
		'user_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'cliente_id',
		'numero',
		'user_id',
		'monto',
		'fecha',
		'estatus'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
