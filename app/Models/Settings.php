<?php
namespace WPSP\app\Models;

use Illuminate\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Observers\SettingsObserver;
use WPSP\app\Policies\SettingsPolicy;

class Settings extends Model {
	use SoftDeletes;

	protected $table      = 'settings';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	protected static function boot(): void {
		parent::boot();
		static::setEventDispatcher( new \Illuminate\Events\Dispatcher() );
		static::observe(new SettingsObserver());
	}

	protected static function booting(): void {
		Gate::policy(Settings::class, SettingsPolicy::class);
	}

}
