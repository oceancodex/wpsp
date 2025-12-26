<?php

namespace WPSP\App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class WPUsersModel extends Model implements Authenticatable {

	use AuthenticatableTrait;

	protected $connection                   = 'wp';
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

//	public function getConnection() {
//		$connection = parent::getConnection();
//		$connection->setTablePrefix('wp_');
//		return $connection;
//	}

}
