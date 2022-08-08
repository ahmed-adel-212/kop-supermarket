<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends EntrustPermission
{
	use SoftDeletes;
	protected $guarded = [];

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}
}