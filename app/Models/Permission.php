<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	protected $guarded = [];

	public function roles()
	{
		return $this->belongsToMany(Role::class);
	}
}