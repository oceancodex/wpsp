<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSPCORE\Traits\ObserversTrait;

class Settings extends Model {
	use SoftDeletes, ObserversTrait;

	protected $table      = 'settings';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	protected static array $observers = [
		\WPSP\app\Observers\SettingsObserver::class,
	];

}
