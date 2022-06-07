<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VEarning
 * 
 * @property string|null $year_month
 * @property string|null $month_year
 * @property string|null $username
 * @property string $full_name
 * @property float|null $net_earnings
 * @property float $fixed_cost
 * @property float|null $commission
 * @property float|null $profit
 *
 * @package App\Models\Entities
 */
class VEarning extends Model
{
	protected $table = 'v_earnings';
	public $incrementing = false;
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'net_earnings' => 'float',
		'fixed_cost' => 'float',
		'commission' => 'float',
		'profit' => 'float'
	];

	protected $fillable = [
		'year_month',
		'month_year',
		'username',
		'full_name',
		'net_earnings',
		'fixed_cost',
		'commission',
		'profit'
	];
}
