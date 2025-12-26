<?php
namespace WPSP\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingsModel extends Model {

	use SoftDeletes;

	protected $connection = 'wp_wpsp';
//	protected $prefix     = 'wp_wpsp_';
	protected $table      = 'settings';
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

}
