<?php
namespace WPSP\App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Database\Base\BaseModel;
use WPSPCORE\Traits\ObserversTrait;

class ProductsModel extends BaseModel {

	use InstancesTrait, SoftDeletes, ObserversTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
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

//	protected static $observers = [
//		\WPSP\App\Observers\ProductsObserver::class,
//	];

//	public function __construct($attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

}
