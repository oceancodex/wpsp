<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\ModelsTrait;
use WPSP\Funcs;
use WPSPCORE\Auth\Traits\VirtualAttributesTrait;
use WPSPCORE\Permission\Traits\PermissionTrait;
use WPSPCORE\Traits\ObserversTrait;

class WPUsersModel extends Model {

	use ModelsTrait, VirtualAttributesTrait, ObserversTrait, PermissionTrait;

	protected $connection = 'wordpress';
	protected $prefix     = 'wp_';
	protected $table      = 'users';
	protected $primaryKey = 'ID';

//	protected $appends;
//	protected $attributeCastCache;
//	protected $attributes;
//	protected $casts;
//	protected $changes;
//	protected $classCastCache;
//	protected $dateFormat;
//	protected $dispatchesEvents;
//	protected $escapeWhenCastingToString;
//	protected $fillable = [];
//	protected $forceDeleting;
	protected $guarded = [];
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

//	protected static array $observers = [
//		\WPSP\app\Observers\UsersObserver::class,
//	];

//	public function __construct(array $attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'wordpress');
//		parent::__construct($attributes);
//	}

	public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(PostsModel::class, 'user_id', 'id');
	}

}
