<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Database\Base\BaseModel;
use WPSPCORE\Traits\ObserversTrait;

class CategoriesModel extends BaseModel {

	use InstancesTrait, SoftDeletes, ObserversTrait;

	protected $connection = 'wordpress';
//	protected $prefix     = 'wp_wpsp_';
	protected $table      = 'categories';
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
//		\WPSP\app\Observers\CategoriesObserver::class,
//	];

//	public function __construct($attributes = []) {
//		$this->getConnection()->setTablePrefix('wp_wpsp_');
//		$this->setConnection(Funcs::instance()->_getDBTablePrefix(false) . 'mysql');
//		parent::__construct($attributes);
//	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function posts() {
		return $this->belongsToMany(PostsModel::class, 'post_category_relationships', 'category_id', 'post_id');
	}

	public function addPost($postId) {
		$this->posts()->attach($postId);
	}

}
