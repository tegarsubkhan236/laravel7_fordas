<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int|null $das_id
 * @property int $level
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property WilayahDa|null $wilayah_da
 * @property Collection|DetailDonatur[] $detail_donaturs
 * @property Collection|ProposalDonatur[] $proposal_donaturs
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'das_id' => 'int',
		'level' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'das_id',
		'level',
		'status'
	];

	public function wilayah_da()
	{
		return $this->belongsTo(WilayahDa::class, 'das_id');
	}

	public function detail_donaturs()
	{
		return $this->hasMany(DetailDonatur::class);
	}

	public function proposal_donaturs()
	{
		return $this->hasMany(ProposalDonatur::class);
	}
}
