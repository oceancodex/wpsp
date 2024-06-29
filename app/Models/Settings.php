<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSP\app\Observers\SettingsObserver;

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

}
