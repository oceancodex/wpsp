<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authors extends Model {
	use SoftDeletes;

	protected $table      = 'authors';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(Posts::class, 'author_id', 'id');
	}

}
