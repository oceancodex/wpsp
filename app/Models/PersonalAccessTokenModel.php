<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\ModelsTrait;
use WPSPCORE\Traits\ObserversTrait;

class PersonalAccessTokenModel extends Model {

	use ModelsTrait, SoftDeletes, ObserversTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
	protected $table      = 'cm_personal_access_tokens';                  // If this table created by custom migration, you need to add prefix "cm_" to the table name, like this: "cm_"
//	protected $primaryKey = 'id';

//	protected $appends;
//	protected $attributeCastCache;
//	protected $attributes;
	protected $casts = [
		'abilities'    => 'json',
		'last_used_at' => 'datetime',
		'expires_at'   => 'datetime',
	];
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
//		\WPSP\app\Observers\PersonalAccessTokenModelObserver::class,
//	];

//	public function __construct(array $attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection('wordpress');
//		parent::__construct($attributes);
//	}

	/**
	 * Check if token can perform ability
	 */
	public function can(string $ability): bool {
		if (in_array('*', $this->abilities)) {
			return true;
		}
		return in_array($ability, $this->abilities);
	}

	/**
	 * Check if token has expired
	 */
	public function isExpired(): bool {
		if (!$this->expires_at) return false;
		return $this->expires_at->isPast();
	}

}
