<?php
namespace OCBP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model {
	use SoftDeletes;

	protected $table      = 'settings';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

}
