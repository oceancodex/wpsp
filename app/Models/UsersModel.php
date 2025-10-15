<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Auth\Traits\VirtualAttributesTrait;
use WPSPCORE\Database\Base\BaseModel;
use WPSPCORE\Permission\Traits\UserPermissionTrait;
use WPSPCORE\Sanctum\Traits\UserSanctumTokensTrait;
use WPSPCORE\Traits\ObserversTrait;

class UsersModel extends BaseModel {

	use InstancesTrait, VirtualAttributesTrait, SoftDeletes, ObserversTrait, UserPermissionTrait, UserSanctumTokensTrait;

	protected $connection                   = 'wordpress';
//	protected $prefix                       = 'wp_wpsp_';
	protected $table                        = 'cm_users';
//	protected $primaryKey                   = 'id';

//	protected $appends                      = [];
//	protected $attributeCastCache;
//	protected $attributes;
	protected $casts                        = ['email_verified_at' => 'datetime', 'last_login_at' => 'datetime'];
//	protected $changes;
//	protected $classCastCache;
//	protected $dateFormat;
//	protected $dispatchesEvents;
//	protected $escapeWhenCastingToString;
	protected $fillable                     = ['name', 'username', 'email', 'password', 'api_token'];
//	protected $forceDeleting;
	protected $guarded                      = [];
//	protected $hidden                       = ['password', 'api_token', 'remember_token'];
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

	protected static $observers = [
		\WPSP\app\Observers\UsersObserver::class,
	];

//	public function __construct($attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts() {
		return $this->hasMany(PostsModel::class, 'user_id', 'id');
	}

}
