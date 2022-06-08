<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $id
 * @property string $title
 * 
 * @property Collection|City[] $cities
 *
 * @package App\Models\Entities
 */
class State extends Model
{
	protected $table = 'state';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $fillable = [
		'title'
	];

	public function cities()
	{
		return $this->hasMany(City::class);
	}
}
