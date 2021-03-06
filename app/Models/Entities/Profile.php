<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

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
 * @property string $zip_code
 * @property bool $is_available
 * @property string $img
 * @property int $city_id
 *
 * @property City $city
 * @property Collection|Friend[] $friends
 *
 * @package App\Models\Entities
 */
class Profile extends Model
{
	protected $table = 'profile';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
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

    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name . ' - ' . $this->id;
    }
}
