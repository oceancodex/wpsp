<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WPSPCORE\Traits\ObserversTrait;

class AccountsModel extends Model {
	use SoftDeletes, ObserversTrait;

	protected $table      = 'cm_accounts';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

}
