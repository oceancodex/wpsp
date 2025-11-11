<?php

namespace WPSP\App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsersModel extends Authenticatable {

	protected $connection                   = 'wordpress';
//	protected $prefix                       = 'wp_wpsp_';
	protected $table                        = 'users';
//	protected $primaryKey                   = 'id';

//	protected $appends                      = [];
//	protected $attributeCastCache;
//	protected $attributes;
	protected $casts                        = ['email_verified_at' => 'datetime', 'last_login_at' => 'datetime'];
//	protected $changes;
//	protected $classCastCache;
//	protected $dateFormat;
//	protected $dispatchesEvents;
//	protected $escapeWhenCastingToString;
	protected $fillable                     = ['name', 'username', 'email', 'password', 'api_token'];
//	protected $forceDeleting;
	protected $guarded                      = [];
//	protected $hidden                       = ['password', 'api_token', 'remember_token'];
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
