<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Friend
 * 
 * @property int $id
 * @property int $profile_id
 * @property int $friend_id
 * 
 * @property Profile $profile
 *
 * @package App\Models\Entities
 */
class Friend extends Model
{
	protected $table = 'friend';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'profile_id' => 'int',
		'friend_id' => 'int'
	];

	protected $fillable = [
		'profile_id',
		'friend_id'
	];

	public function profile()
	{
		return $this->belongsTo(Profile::class);
	}
}
