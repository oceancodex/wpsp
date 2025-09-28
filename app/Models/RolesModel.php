<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\PermissionTrait;
use WPSP\app\Traits\ModelsTrait;
use WPSP\Funcs;
use WPSPCORE\Traits\ObserversTrait;

class RolesModel extends Model implements \WPSPCORE\Permission\Contracts\RoleContract {

	use ModelsTrait, SoftDeletes, ObserversTrait, PermissionTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
	protected $table      = 'cm_roles';
//	protected $primaryKey = 'id';

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
//		\WPSP\app\Observers\SettingsObserver::class,
//	];

//	public function __construct(array $attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

	public function permissions() {
		return $this->belongsToMany(
			PermissionsModel::class,
			'cm_role_has_permissions',
			'role_id',
			'permission_id'
		);
	}

	public function getName(): string {
		return (string) $this->attributes['name'];
	}

	public function getGuardName(): ?string {
		return $this->attributes['guard_name'] ?? null;
	}

}
