<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Database\Base\BaseMongoDBModel;
use WPSPCORE\Traits\ObserversTrait;

class VideosModel extends BaseMongoDBModel {

	use InstancesTrait, SoftDeletes, ObserversTrait;

	protected $connection                   = 'mongodb';
//	protected $prefix                       = 'wp_wpsp_';
	protected $table                        = 'wpsp_mongodb_videos';
//	protected $primaryKey                   = 'id';

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

//	protected static $observers = [
//		\WPSP\app\Observers\SettingsObserver::class,
//	];

//	public function __construct($attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

}
