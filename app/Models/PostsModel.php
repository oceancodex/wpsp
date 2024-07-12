<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSPCORE\Traits\ObserversTrait;

class PostsModel extends Model {
	use SoftDeletes, ObserversTrait;

//	protected $connection;
	protected $table      = 'posts';
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
//		\WPSP\app\Observers\PostsObserver::class,
//	];

	public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
		return $this->belongsToMany(CategoriesModel::class, 'post_category_relationships', 'post_id', 'category_id');
	}

	public function addCategory($categoryId): void {
		$this->categories()->attach($categoryId);
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(UsersModel::class, 'user_id');
	}
	
}
