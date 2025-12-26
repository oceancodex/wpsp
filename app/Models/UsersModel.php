<?php

namespace WPSP\App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Sử dụng: spatie/laravel-permission
use WPSP\App\Notifications\UsersPasswordResetLinkNotification;
use WPSP\App\Observers\UsersObserver;

//#[ObservedBy([UsersObserver::class])]
class UsersModel extends Authenticatable implements MustVerifyEmail {

	use Notifiable;
//	use HasApiTokens, Notifiable;           // Sử dụng: Gate/Policiy theo Laravel và Laravel/sanctum
//	use HasRoles, HasApiTokens, Notifiable; // Sử dụng: Spatie/laravel-permission và Laravel/sanctum

	protected $connection                   = 'wp_wpsp';
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
	protected $hidden                       = ['password', 'api_token', 'remember_token'];
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

	/**
	 * Gửi email chứa link reset password (queue).
	 */
	public function sendPasswordResetNotification($token) {
		$this->notify(new UsersPasswordResetLinkNotification($token));
	}

}
