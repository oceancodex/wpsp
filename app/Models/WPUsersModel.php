<?php

namespace WPSP\App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class WPUsersModel implements Authenticatable {

	use AuthenticatableTrait;

	protected $connection                   = 'wordpress';
	protected $prefix                       = 'wp_';
	protected $table                        = 'users';
	protected $primaryKey                   = 'ID';

//	protected $appends;
//	protected $attributeCastCache;
//	protected $attributes;
//	protected $casts;
//	protected $changes;
//	protected $classCastCache;
//	protected $dateFormat;
//	protected $dispatchesEvents;
//	protected $escapeWhenCastingToString;
//	protected $fillable                     = [];
//	protected $forceDeleting;
	protected $guarded                      = [];
//	protected $hidden;
//	protected $keyType;
//	protected $observables;
//	protected $original;
//	protected $perPage;
//	protected $relations;
//	protected $touches;
//	protected $visible;
//	protected $with;
//	protected $withCount;

//	public    $exists;
//	public    $incrementing;
//	public    $preventsLazyLoading;
//	public    $timestamps;
//	public    $usesUniqueIds;
//	public    $wasRecentlyCreated;

	protected $user;

	public function __construct($user) {
		$this->user = $user;
	}

	public function getAuthIdentifierName() {
		return 'ID';
	}

	public function getAuthIdentifier() {
		return $this->user->ID;
	}

	public function getAuthPassword() {
		return $this->user->user_pass;
	}

	// Remember token (WP không dùng)
	public function getRememberToken() {
		return null;
	}

	public function setRememberToken($value) {}

	public function getRememberTokenName() {
		return null;
	}

	// Helper: chuyển dữ liệu ra dạng mảng
	public function toArray(): array {
		return (array)$this->user;
	}

	public function __get($key) {
		return $this->user->$key ?? null;
	}

}
