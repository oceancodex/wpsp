<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSPCORE\Traits\ObserversTrait;

class ProductsModel extends Model {
	use SoftDeletes, ObserversTrait;

	protected $connection = 'wpsp_mysql';
	protected $table      = 'products';
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
//		\WPSP\app\Observers\ProductsObserver::class,
//	];

}
