<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id
 * @property string $title
 * @property int $state_id
 * 
 * @property State $state
 * @property Collection|Profile[] $profiles
 *
 * @package App\Models\Entities
 */
class City extends Model
{
	protected $table = 'city';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'state_id' => 'int'
	];

	protected $fillable = [
		'title',
		'state_id'
	];

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function profiles()
	{
		return $this->hasMany(Profile::class);
	}
}
