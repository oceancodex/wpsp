<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\ModelsTrait;
use WPSPCORE\Auth\Traits\VirtualAttributesTrait;
use WPSPCORE\Permission\Traits\PermissionTrait;
use WPSPCORE\Sanctum\Traits\SanctumTokensTrait;
use WPSPCORE\Traits\ObserversTrait;

class UsersModel extends Model {

	use ModelsTrait, VirtualAttributesTrait, SoftDeletes, ObserversTrait, PermissionTrait, SanctumTokensTrait;

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

//	protected static array $observers = [
//		\WPSP\app\Observers\AccountsObserver::class,
//	];

//	public function __construct(array $attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

}
