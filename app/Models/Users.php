<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model {
	use SoftDeletes;

	protected $table      = 'users';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(Posts::class, 'user_id', 'id');
	}

}
