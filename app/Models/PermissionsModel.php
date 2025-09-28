<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\ModelsTrait;
use WPSP\Funcs;
use WPSPCORE\Traits\ObserversTrait;

class PermissionsModel extends Model {

	use ModelsTrait, SoftDeletes, ObserversTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
	protected $table      = 'cm_permissions';                  // If this table created by custom migration, you need to add prefix "cm_" to the table name, like this: "cm_cm_permissions"
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
	protected $fillable = ['name', 'guard_name'];
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
//		\WPSP\app\Observers\PermissionsModelObserver::class,
//	];

//	public function __construct(array $attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection('wordpress');
//		parent::__construct($attributes);
//	}

	public function roles() {
		return $this->belongsToMany(
			RolesModel::class,
			'cm_role_has_permissions',
			'permission_id',
			'role_id'
		);
	}

	public function getName(): string {
		return (string)$this->attributes['name'];
	}

	public function getGuardName(): ?string {
		return $this->attributes['guard_name'] ?? null;
	}

}
