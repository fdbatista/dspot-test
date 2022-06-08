<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $address
 * @property int $zip_code
 * @property bool $is_available
 * @property string $img
 * @property int $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property City $city
 * @property Collection|Friend[] $friends
 *
 * @package App\Models\Entities
 */
class Profile extends Model
{
	protected $table = 'profile';
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'zip_code' => 'int',
		'is_available' => 'bool',
		'city_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'phone',
		'address',
		'zip_code',
		'is_available',
		'img',
		'city_id'
	];

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function friends()
	{
		return $this->hasMany(Friend::class);
	}
}
