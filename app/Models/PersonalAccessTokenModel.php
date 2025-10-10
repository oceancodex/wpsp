<?php

namespace WPSP\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\ModelsTrait;
use WPSPCORE\Traits\ObserversTrait;

class PersonalAccessTokenModel extends Model {

	use ModelsTrait, SoftDeletes, ObserversTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
	protected $table = 'cm_personal_access_tokens';                  // If this table created by custom migration, you need to add prefix "cm_" to the table name, like this: "cm_"
//	protected $primaryKey = 'id';

//	protected $appends;
//	protected $attributeCastCache;
//	protected $attributes;
	protected $casts = [
		'abilities'                => 'json',
		'last_used_at'             => 'datetime',
		'expires_at'               => 'datetime',
		'refresh_token_expires_at' => 'datetime',
	];
//	protected $changes;
//	protected $classCastCache;
//	protected $dateFormat;
//	protected $dispatchesEvents;
//	protected $escapeWhenCastingToString;
	protected $fillable = [
		'name',
		'token',
		'refresh_token',
		'abilities',
		'expires_at',
		'refresh_token_expires_at',
	];
//	protected $forceDeleting;
	protected $guarded = [];
	protected $hidden  = [
		'token',
	];
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

	public function tokenable(): \Illuminate\Database\Eloquent\Relations\MorphTo {
		return $this->morphTo('tokenable');
	}

	/*
	 *
	 */

	public function can(string $ability): bool {
		// Nếu expires_at là string, ép về Carbon
		$expiresAt = $this->expires_at instanceof \DateTimeInterface
			? $this->expires_at
			: Carbon::parse($this->expires_at);

		// Kiểm tra token còn hạn
		if ($expiresAt->lessThan(Carbon::now())) {
			return false;
		}

		// Kiểm tra quyền (abilities)
		$abilities = $this->abilities ?? [];

		return in_array('*', $abilities, true) || in_array($ability, $abilities, true);
	}

	public function cant($ability): bool {
		return !$this->can($ability);
	}

}
